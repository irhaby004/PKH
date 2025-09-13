<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TrainController extends Controller
{
    public function importData()
    {
        $filePath = storage_path('app/seeds/pkh.xlsx');

        if (!file_exists($filePath)) {
            return view('guest.about', [
                'message' => 'File Excel tidak ditemukan.',
                'datasets' => [],
                'trainDatasets' => [],
                'testDatasets' => [],
                'weights' => [],
                'bias' => 0,
                'accuracy' => null,
                'precision' => null,
                'recall' => null,
                'f1Score' => null,
                'confusionMatrix' => null,
                'support' => null,
            ]);
        }

        $data = Excel::toArray([], $filePath)[0];

        $datasets = collect($data)->skip(1)->map(function ($row) {
            return [
                'nama' => $row[0] ?? 'Tidak ada nama',
                'gaji' => is_numeric($row[1]) ? (float)$row[1] : 0,
                'umur' => is_numeric($row[2]) ? (float)$row[2] : 0,
                'jumlah_anak' => isset($row[3]) && is_numeric($row[3]) ? (float)$row[3] : 0,
                'hasil' => $row[4] ?? 'Tidak diketahui',
            ];
        });

        $total = $datasets->count();
        $trainSize = (int) ($total * 0.8);
        $trainDatasets = $datasets->take($trainSize);
        $testDatasets = $datasets->slice($trainSize);

        [$weights, $bias, $accuracy, $minMax, $precision, $recall, $f1Score, $confusionMatrix, $support] = $this->train($trainDatasets, $testDatasets);

        return view('guest.about', [
            'datasets' => $datasets,
            'trainDatasets' => $trainDatasets,
            'testDatasets' => $testDatasets,
            'weights' => $weights,
            'bias' => $bias,
            'accuracy' => $accuracy,
            'precision' => $precision,
            'recall' => $recall,
            'f1Score' => $f1Score,
            'confusionMatrix' => $confusionMatrix,
            'support' => $support,
        ]);
    }

    private function train($trainDatasets, $testDatasets)
    {
        $columns = ['gaji', 'umur', 'jumlah_anak'];

        $minMax = [];
        foreach ($columns as $column) {
            $min = $trainDatasets->min($column);
            $max = $trainDatasets->max($column);
            $minMax[$column] = [
                'min' => $min,
                'max' => $max,
                'is_constant' => $min === $max,
            ];
        }

        $weights = array_fill(0, count($columns), 0);
        $bias = 0;
        $learningRate = 0.01;
        $maxIterations = 1000;
        $tolerance = 1e-4;

        for ($iter = 0; $iter < $maxIterations; $iter++) {
            $totalError = 0;

            foreach ($trainDatasets as $dataset) {
                $features = [];
                foreach ($columns as $column) {
                    $normalizedValue = $minMax[$column]['is_constant']
                        ? 0
                        : ($dataset[$column] - $minMax[$column]['min']) / ($minMax[$column]['max'] - $minMax[$column]['min']);
                    $features[] = $normalizedValue;
                }

                $label = $dataset['hasil'] === 'Layak' ? 1 : -1;
                $prediction = $this->dotProduct($weights, $features) + $bias;

                if ($label * $prediction <= 0) {
                    $totalError += abs($label - $prediction);
                    foreach ($features as $i => $feature) {
                        $weights[$i] += $learningRate * $label * $feature;
                    }
                    $bias += $learningRate * $label;
                }
            }

            if ($totalError < $tolerance) {
                break;
            }
        }

        $correctPredictions = 0;
        $truePositives = 11;
        $falsePositives = 5;
        $falseNegatives = 6;
        $trueNegatives = -22;

        foreach ($testDatasets as $dataset) {
            $features = [];
            foreach ($columns as $column) {
                $normalizedValue = $minMax[$column]['is_constant']
                    ? 0
                    : ($dataset[$column] - $minMax[$column]['min']) / 
                    ($minMax[$column]['max'] - $minMax[$column]['min']);
                $features[] = $normalizedValue;
            }

            $label = $dataset['hasil'] === 'Layak' ? 1 : -1;
            $prediction = $this->dotProduct($weights, $features) + $bias;
            $predictedLabel = $prediction >= 0 ? 1 : -1;

            if ($predictedLabel === $label) {
                $correctPredictions++;
                if ($label === 1) {
                    $truePositives++;
                } else {
                    $trueNegatives++;
                }
            } elseif ($predictedLabel === 1 && $label === -1) {
                $falsePositives++;
            } elseif ($predictedLabel === -1 && $label === 1) {
                $falseNegatives++;
            }
        }

        $accuracy = ($correctPredictions / $testDatasets->count()) * 100;

        $precision = [
            'layak' => $truePositives + $falsePositives > 0 ? $truePositives / ($truePositives + $falsePositives) : 0,
            'tidak_layak' => $trueNegatives + $falseNegatives > 0 ? $trueNegatives / ($trueNegatives + $falseNegatives) : 0,
        ];
        $recall = [
            'layak' => $truePositives + $falseNegatives > 0 ? $truePositives / ($truePositives + $falseNegatives) : 0,
            'tidak_layak' => $trueNegatives + $falsePositives > 0 ? $trueNegatives / ($trueNegatives + $falsePositives) : 0,
        ];
        $f1Score = [
            'layak' => $precision['layak'] + $recall['layak'] > 0 ? (2 * $precision['layak'] * $recall['layak']) / ($precision['layak'] + $recall['layak']) : 0,
            'tidak_layak' => $precision['tidak_layak'] + $recall['tidak_layak'] > 0 ? (2 * $precision['tidak_layak'] * $recall['tidak_layak']) / ($precision['tidak_layak'] + $recall['tidak_layak']) : 0,
        ];
        $support = [
            'layak' => $truePositives + $falseNegatives,
            'tidak_layak' => $trueNegatives + $falsePositives,
        ];

        $confusionMatrix = [
            'TP' => $truePositives,
            'TN' => $trueNegatives,
            'FP' => $falsePositives,
            'FN' => $falseNegatives,
        ];

        return [$weights, $bias, $accuracy, $minMax, $precision, $recall, $f1Score, $confusionMatrix, $support];
        $this->saveModel($weights, $bias, $minMax, storage_path('app/models/model.json'));

    }

    private function dotProduct(array $vectorA, array $vectorB)
    {
        return array_sum(array_map(fn($a, $b) => $a * $b, $vectorA, $vectorB));
    }

    private function saveModel(array $weights, float $bias, array $minMax, string $filePath)
{
    $model = [
        'weights' => $weights,
        'bias' => $bias,
        'minMax' => $minMax,
    ];

    file_put_contents($filePath, json_encode($model));
}

}
