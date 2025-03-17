<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriksasSeeder extends Seeder
{
    public function run()
    {
        DB::table('periksas')->insert([
            [
                'id_pasien' => 1,
                'id_dokter' => 2,
                'tgl_periksa' => now(),
                'catatan' => 'Pasien mengalami demam ringan',
                'biaya_periksa' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
