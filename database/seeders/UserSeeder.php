<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'nama'    => 'Admin Sekolah',
            'nip_nis' => '12345678',
            'password' => Hash::make('admin123'),
            'role'    => 'admin',
            'kelas'   => null,
        ]);

        // SISWA
        User::create([
            'nama'    => 'Budi Siswa',
            'nip_nis' => '1234567',
            'password' => Hash::make('siswa123'),
            'role'    => 'siswa',
            'kelas'   => 'XI',
        ]);
    }
}
