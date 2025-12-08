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

        $bankSampah = BankSampah::first();
if (!$bankSampah) {
    $bankSampah = BankSampah::create([
        'nama' => 'Bank Sampah Default',
        'alamat' => 'Alamat Default',
    ]);
}

// Super Admin
$admin = User::updateOrCreate(
    ['email' => 'admin@dlh.go.id'],
    [
        'name' => 'Admin DLH',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
    ]
);

// Bank Sampah Admin
$banksampahUser = User::updateOrCreate(
    ['email' => 'pedulilingkungan@gmail.com'],
    [
        'name' => 'Admin Pengelola',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
        'bank_sampah_id' => $bankSampah->id, // PASTIKAN ADA BANK SAMPAH
    ]
);

        // Assign roles
        $admin->syncRoles(['admin']);
        $banksampahUser->syncRoles(['bank_sampah']);

        $this->command->info("✓ Admin created: {$admin->email}");
        $this->command->info("✓ Bank Sampah user created: {$banksampahUser->email}");
    }
}
