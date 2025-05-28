<?php

namespace Database\Seeders;
use App\Models\JanjiPeriksa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //CALL ALL DATA WANT SEEDER
        $this->call([
            PoliSeeder::class,
            UsersTableSeeder::class,
            JadwalPeriksaTableSeeder::class,
            JanjiPeriksaSeeder::class,
            ObatTableSeeder::class,
            PeriksaTableSeeder::class,
            DetailPeriksasSeeder::class,
        ]);
    }
}