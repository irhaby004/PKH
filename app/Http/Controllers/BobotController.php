<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class BobotController extends Controller
{
    public function index()
    {
        // Mengambil semua data Kriteria dan mengurutkannya berdasarkan peringkat secara ascending
        $Kriterias = Kriteria::orderBy('peringkat', 'asc')->get();

        // Menghitung jumlah kriteria yang ada
        $kriteriaLength = count($Kriterias);

        // Mengambil kriteria terakhir untuk digunakan sebagai pembagi dalam perhitungan ROC
        $lastKriteria = $Kriterias->last();

        // Loop untuk menghitung nilai ROC setiap kriteria
        foreach ($Kriterias as $index => $kriteria) {
            $tempIndex = $index; // Index sementara untuk perhitungan ROC
            $roc = 0; // Inisialisasi nilai ROC

            // Loop untuk menjumlahkan nilai kebalikan dari peringkat
            while ($tempIndex < $kriteriaLength) {
                $roc += 1 / (int)$Kriterias[$tempIndex]->peringkat; // Menambahkan nilai kebalikan dari peringkat
                $tempIndex++; // Increment index sementara
            }

            // Membagi nilai ROC dengan peringkat kriteria terakhir untuk mendapatkan nilai akhir
            $roc = $roc / (int)$lastKriteria->peringkat;

            // Mengurangi nilai desimal menjadi dua angka di belakang koma
            $Kriterias[$index]['roc'] = number_format($roc, 2);
        }

        // Mengirimkan data Kriteria ke tampilan 'admin.bobot.bobot'
        return view('admin.bobot.bobot', compact('Kriterias'));
    }
}
