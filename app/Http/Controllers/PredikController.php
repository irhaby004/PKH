<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PredictController extends Controller
{
    private function loadModel(string $filePath)
    {
        if (!file_exists($filePath)) {
            throw new \Exception("Model file not found: $filePath");
        }

        $model = json_decode(file_get_contents($filePath), true);

        return [
            'weights' => $model['weights'],
            'bias' => $model['bias'],
            'minMax' => $model['minMax'],
        ];
    }

    public function predict(Request $request)
    {
        $filePath = storage_path('app/models/model.json');

        try {
            $model = $this->loadModel($filePath);

            $weights = $model['weights'];
            $bias = $model['bias'];
            $minMax = $model['minMax'];

            $input = [
                'gaji' => $request->input('gaji'),
                'umur' => $request->input('umur'),
                'jumlah_anak' => $request->input('jumlah_anak'),
            ];

            $features = [];
            foreach ($minMax as $column => $range) {
                $features[] = $range['is_constant']
                    ? 0
                    : ($input[$column] - $range['min']) / ($range['max'] - $range['min']);
            }

            $prediction = $this->dotProduct($weights, $features) + $bias;
            $result = $prediction >= 0 ? 'Layak' : 'Tidak Layak';

            return response()->json(['prediction' => $result, 'value' => $prediction]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function dotProduct(array $vectorA, array $vectorB)
    {
        return array_sum(array_map(fn($a, $b) => $a * $b, $vectorA, $vectorB));
    }
}
