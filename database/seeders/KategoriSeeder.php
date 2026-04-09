<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            'Ruang Kelas',
            'Kantin',
            'Toilet',
            'Lapangan',
            'Laboratorium',
            'Perpustakaan',
            'Aula',
            'Gudang',
        ];

        foreach ($kategoris as $k) {
            Kategori::create(['nama_kategori' => $k]);
        }
    }
}
