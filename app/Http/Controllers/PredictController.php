<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class PredictController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('peringkat', 'asc')->get();

        // Hitung ROC sebagai bobot
        $kriteriaLength = count($kriterias);
        $lastKriteria = $kriterias->last();

        foreach ($kriterias as $index => $kriteria) {
            $tempIndex = $index;
            $roc = 0;

            while ($tempIndex < $kriteriaLength) {
                $roc += 1 / (int)$kriterias[$tempIndex]->peringkat;
                $tempIndex++;
            }

            $roc = $roc / (int)$lastKriteria->peringkat;
            $kriterias[$index]['roc'] = number_format($roc, 2);
        }

        $datasets = Dataset::with('details.kriteria')->get();

        foreach ($datasets as $dataset) {
            $totalScore = 0;
            $perhitungan = []; // Menyimpan detail perhitungan SVM untuk setiap kriteria

            // Deklarasi awal untuk jumlah anak dan umur
            $jumlahAnak = 0;
            $umur = 0;

            foreach ($dataset->details as $detail) {
                $kriteriaId = $detail->kriteria->id;
                $kriteria = $kriterias->where('id', $kriteriaId)->first();

                // Ambil nilai umur dan jumlah anak berdasarkan nama kriteria
                if ($kriteria && $kriteria->nama_kriteria === 'jumlah_anak') {
                    $jumlahAnak = $detail->status;
                }
                if ($kriteria && $kriteria->nama_kriteria === 'umur') {
                    $umur = $detail->status;
                }

                if ($kriteria) {
                    $min = $kriteria->min ?? 0;
                    $max = $kriteria->max ?? 1;
                    $bobot = $kriteria['roc'];

                    $normalizedValue = ($detail->status - $min) / ($max - $min);
                    $score = $normalizedValue * $bobot;

                    $totalScore += $score;

                    $perhitungan[] = [
                        'kriteria' => $kriteria->nama_kriteria,
                        'min' => $min,
                        'max' => $max,
                        'status' => $detail->status,
                        'normalized' => number_format($normalizedValue, 2),
                        'bobot' => $bobot,
                        'score' => number_format($score, 2),
                    ];
                }
            }

            // Logika tambahan: Lansia dan jumlah anak
            if ($jumlahAnak == 0) {
                if ($umur >= 60) {
                    $dataset->roc = 'Layak'; // Lansia tanpa anak -> Layak
                } else {
                    $dataset->roc = 'Tidak Layak'; // Tidak ada anak dan bukan lansia -> Tidak Layak
                }
            } else {
                $dataset->roc = $totalScore >= 0.47 ? 'Tidak Layak' : 'Layak'; // Logika biasa
            }

            $dataset->perhitungan = $perhitungan; // Simpan detail perhitungan
            $dataset->totalScore = number_format($totalScore, 2); // Simpan total skor
        }

        return view('guest.predict', compact('datasets', 'kriterias'));
    }
}
