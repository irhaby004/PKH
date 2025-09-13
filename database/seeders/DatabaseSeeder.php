<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel; // Tambahkan ini
use App\Imports\DatasetImport; // Pastikan Anda memiliki class ini

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Tambahkan Kriteria
        Kriteria::create([
            'nama_kriteria' => 'gaji',
            'peringkat' => '1',
            'min' => '0',
            'max' => '10000000',
        ]);

        Kriteria::create([
            'nama_kriteria' => 'umur',
            'peringkat' => '3',
            'min' => '0',
            'max' => '150',
        ]);

        Kriteria::create([
            'nama_kriteria' => 'jumlah_anak',
            'peringkat' => '2',
            'min' => '0',
            'max' => '15',
        ]);

        // Tambahkan User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'parinduriahyar@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('$Ahyar123'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'role' => 'user',
        ]);

        // Import Data dari Excel
        Excel::import(new DatasetImport, storage_path('app/seeds/pkh.xlsx'));
    }
}
