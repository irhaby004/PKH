<?php

namespace App\Imports;

use App\Models\Dataset;
use App\Models\Dataset_Detail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DatasetImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Buat record utama Dataset
        $dataset = Dataset::create([
            'nama' => $row['nama'], // Sesuaikan dengan header Excel
        ]);

        // Buat detail untuk setiap kriteria
        Dataset_Detail::create([
            'id_dataset' => $dataset->id,
            'id_kriteria' => 1, // ID kriteria 'gaji'
            'status' => $row['gaji'],
        ]);

        Dataset_Detail::create([
            'id_dataset' => $dataset->id,
            'id_kriteria' => 2, // ID kriteria 'jumlah_anak'
            'status' => $row['umur'],
        ]);

        Dataset_Detail::create([
            'id_dataset' => $dataset->id,
            'id_kriteria' => 3, // ID kriteria 'umur'
            'status' => $row['jumlah_anak'],
        ]);
    }
}
