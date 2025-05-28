<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Only seed in non-production environments
            if (app()->environment('production')) {
                $this->command->warn('Skipping user seeding in production environment.');
                return;
            }

            // Check if poli table exists and has data (for foreign key constraint)
            if (!DB::table('poli')->exists() || DB::table('poli')->count() === 0) {
                $this->command->warn('Poli table is empty. Please run PoliSeeder first.');
                return;
            }

            // Clear existing data safely
            $this->clearExistingData();

            // Insert users data
            $this->insertUsers();

            $this->command->info('Users seeded successfully!');

        } catch (Exception $e) {
            $this->command->error('Error seeding users: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Clear existing users data safely
     */
    private function clearExistingData(): void
    {
        try {
            // For MySQL
            if (DB::getDriverName() === 'mysql') {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('users')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            } else {
                // For other databases, use delete instead of truncate
                DB::table('users')->delete();
            }
        } catch (Exception $e) {
            // Fallback: use delete if truncate fails
            DB::table('users')->delete();
        }
    }

    /**
     * Insert users data
     */
    private function insertUsers(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Kebon Jeruk No. 1, Jakarta',
                'no_hp' => '081234567890',
                'role' => 'admin',
                'no_ktp' => 1111111111111111,
                'no_rm' => '202201001',
                'poli_id' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. John Doe',
                'email' => 'doctor1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Kebon Jeruk No. 2, Jakarta',
                'no_hp' => '081234567891',
                'role' => 'dokter',
                'no_ktp' => 1234567890123456,
                'no_rm' => '202101003',
                'poli_id' => $this->getValidPoliId(1),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'patient1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Raya No. 10, Jakarta',
                'no_hp' => '082345678901',
                'role' => 'pasien',
                'no_ktp' => 2137267890126723,
                'no_rm' => '202201002',
                'poli_id' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Sarah Johnson',
                'email' => 'doctor2@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Sutan Syahrir No. 2, Bandung',
                'no_hp' => '083456789012',
                'role' => 'dokter',
                'no_ktp' => 2137267890123459,
                'no_rm' => '202109004',
                'poli_id' => $this->getValidPoliId(2),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Smith',
                'email' => 'patient2@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Merdeka No. 15, Surabaya',
                'no_hp' => '084567890123',
                'role' => 'pasien',
                'no_ktp' => 1234567890123412,
                'no_rm' => '202101038',
                'poli_id' => null,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. William Brown',
                'email' => 'doctor3@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'alamat' => 'Jl. Pahlawan No. 5, Yogyakarta',
                'no_hp' => '085678901234',
                'role' => 'dokter',
                'no_ktp' => 1234563211234567,
                'no_rm' => '202101022',
                'poli_id' => $this->getValidPoliId(3),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert users one by one to better handle errors
        foreach ($users as $user) {
            try {
                DB::table('users')->insert($user);
            } catch (Exception $e) {
                $this->command->error("Failed to insert user: {$user['name']} - " . $e->getMessage());
                throw $e;
            }
        }
    }

    /**
     * Get valid poli_id or null if not exists
     */
    private function getValidPoliId(?int $poliId): ?int
    {
        if ($poliId === null) {
            return null;
        }

        $exists = DB::table('poli')->where('id', $poliId)->exists();
        return $exists ? $poliId : null;
    }
}