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
        $banksampah = User::updateOrCreate(
            ['email' => 'pedulilingkungan@gmail.com'],
            [
                'name' => 'Admin pengelola',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Assign roles
        $admin->syncRoles(['admin']);
        $banksampah->syncRoles(['bank_sampah']);
    }
}
