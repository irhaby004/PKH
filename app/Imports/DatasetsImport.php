<?php

namespace App\Imports;

use App\Models\Dataset;
use Maatwebsite\Excel\Concerns\ToModel;

class DatasetsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $nama   = ucwords(strtolower(trim($row[0])));
        $jk     = strtoupper(trim($row[1]));
        $umur   = strtolower(trim($row[2]));
        $weight = trim($row[3]);
        $height = trim($row[4]);

        if ($nama == '' || $nama == '-' || $jk == '' || $jk == '-' || $umur == '' || $umur == '-' || $weight == '' || $weight == '-' || $height == '' || $height == '-') {
            return null;
        }

        $umur = explode('-', $umur);
        $jumlahUmur = 0;
        foreach ($umur as $u) {
            if (str_contains($u, 'tahun')) {
                $tempUmur = (int)str_replace([' ', 'tahun'], '', $u);
                $jumlahUmur += $tempUmur * 365;
            } else if (str_contains($u, 'bulan')) {
                $tempUmur = (int)str_replace([' ', 'bulan'], '', $u);
                $jumlahUmur += $tempUmur * 30;
            } else if (str_contains($u, 'hari')) {
                $tempUmur = (int)str_replace([' ', 'hari'], '', $u);
                $jumlahUmur += $tempUmur;
            }
        }

        if ($jumlahUmur == 0) {
            return null;
        }

        return new Dataset([
            'name'   => $nama,
            'gender' => $jk,
            'age'    => $jumlahUmur,
            'weight' => $weight,
            'height' => $height,
        ]);
    }
}
