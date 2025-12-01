<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        $admin = User::create([
            'name' => 'Admin DLH',
            'email' => 'admin@dlh.go.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $banksampah = User::create([
            'name' => 'Admin pengelola',
            'email' => 'pedulilingkungan@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'bank_sampah_id' => 1,
        ]);

        $admin->assignRole('admin');
        $banksampah->assignRole('bank_sampah');

        $this->command->info(' Admin user created successfully!');
        $this->command->info('  Email: admin@dlh.go.id');
        $this->command->info('  Password: password');
    }
}
