<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'Pasien Satu',
                'alamat' => 'Jl. Kesehatan No. 1',
                'no_hp' => '081234567890',
                'email' => 'pasien1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'pasien',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dokter Satu',
                'alamat' => 'Jl. Medis No. 2',
                'no_hp' => '081234567891',
                'email' => 'dokter1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'dokter',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
