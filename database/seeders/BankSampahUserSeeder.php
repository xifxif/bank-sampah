<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BankSampah;
use Illuminate\Support\Facades\Hash;

class BankSampahUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah bank sampah sudah ada
        $totalBank = BankSampah::count();

        if ($totalBank < 1) {
            $this->command->error('❌ Tidak ada data bank sampah! Jalankan BankSampahSeeder dulu.');
            return;
        }

        $users = [
            [
                'name' => 'Operator Berkah Lestari',
                'email' => 'operator.berkahlestari@banksampah.id',
                'password' => Hash::make('password123'),
                'bank_sampah_id' => 1,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Operator Hijau Mandiri',
                'email' => 'operator.hijaumandiri@banksampah.id',
                'password' => Hash::make('password123'),
                'bank_sampah_id' => 2,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Operator Sejahtera Bersama',
                'email' => 'operator.sejahtera@banksampah.id',
                'password' => Hash::make('password123'),
                'bank_sampah_id' => 3,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Operator Bumi Asri',
                'email' => 'operator.bumiasri@banksampah.id',
                'password' => Hash::make('password123'),
                'bank_sampah_id' => 4,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Operator Cibeureum Bersih',
                'email' => 'operator.cibeureum@banksampah.id',
                'password' => Hash::make('password123'),
                'bank_sampah_id' => 5,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Operator Maju Bersama',
                'email' => 'operator.majubersama@banksampah.id',
                'password' => Hash::make('password123'),
                'bank_sampah_id' => 6,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Operator Peduli Lingkungan',
                'email' => 'operator.peduli@banksampah.id',
                'password' => Hash::make('password123'),
                'bank_sampah_id' => 7,
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Operator Harapan Kita',
                'email' => 'operator.harapan@banksampah.id',
                'password' => Hash::make('password123'),
                'bank_sampah_id' => 8,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $data) {

            // Cek apakah bank_sampah_id valid
            if (!BankSampah::find($data['bank_sampah_id'])) {
                $this->command->warn("⚠ Bank sampah ID {$data['bank_sampah_id']} tidak ditemukan — user {$data['email']} dilewati.");
                continue;
            }

            $user = User::create($data);
            $user->assignRole('bank_sampah');

            $this->command->info('✓ User created: ' . $data['email']);
        }

        // Output login info
        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('BANK SAMPAH USER LOGIN CREDENTIALS');
        $this->command->info('========================================');
        $this->command->info('');

        foreach ($users as $data) {
            $this->command->info('Email: ' . $data['email']);
            $this->command->info('Password: password123');
            $this->command->info('----------------------------------------');
        }

        $this->command->info('');
        $this->command->info('Total seed selesai!');
    }
}
