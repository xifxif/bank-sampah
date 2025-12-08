<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class, // Jalankan dulu role/permission
            AdminSeeder::class,          // Baru admin
            // tambahkan seeder lain kalau ada
        ]);
    }
}