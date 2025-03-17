<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatsSeeder extends Seeder
{
    public function run()
    {
        DB::table('obats')->insert([
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet 500mg',
                'harga' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Kapsul 250mg',
                'harga' => 8000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
