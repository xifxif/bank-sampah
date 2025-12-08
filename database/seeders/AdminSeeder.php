<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BankSampah;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Starting AdminSeeder...');

        // Pastikan ada Bank Sampah
        $bankSampah = BankSampah::first();
        if (!$bankSampah) {
            $this->command->info('Bank Sampah kosong, membuat default...');
            $bankSampah = BankSampah::create([
                'nama' => 'Bank Sampah Default',
                'alamat' => 'Alamat Default',
            ]);
        }

        // Create Super Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@dlh.go.id'],
            [
                'name' => 'Admin DLH',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create Bank Sampah Admin
        $banksampahUser = User::updateOrCreate(
            ['email' => 'pedulilingkungan@gmail.com'],
            [
                'name' => 'Admin Pengelola',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'bank_sampah_id' => $bankSampah->id, // HARUS ada
            ]
        );

        // Assign roles
        $admin->syncRoles(['admin']);
        $banksampahUser->syncRoles(['bank_sampah']);

        $this->command->info("✓ Admin created: {$admin->email}");
        $this->command->info("✓ Bank Sampah user created: {$banksampahUser->email}");
    }
}
