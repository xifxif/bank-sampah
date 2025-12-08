<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            WilayahSeeder::class,
            JenisSampahSeeder::class,
            BankSampahSeeder::class,
            AdminSeeder::class,
            BankSampahUserSeeder::class,
        ]);
    }
}