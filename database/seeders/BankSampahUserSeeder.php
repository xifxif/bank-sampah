<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BankSampahUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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

        foreach ($users as $userData) {
            $user = User::create($userData);
            $user->assignRole('bank_sampah');

            $this->command->info('✓ User created: ' . $userData['email']);
        }

        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('BANK SAMPAH USERS - LOGIN CREDENTIALS');
        $this->command->info('========================================');
        $this->command->info('');

        foreach ($users as $userData) {
            $this->command->info('Email: ' . $userData['email']);
            $this->command->info('Password: password123');
            $this->command->info('----------------------------------------');
        }

        $this->command->info('');
        $this->command->info('Total: ' . count($users) . ' operator bank sampah berhasil dibuat!');
    }
}
