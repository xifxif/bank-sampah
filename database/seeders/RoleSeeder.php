<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $bankSampahRole = Role::create(['name' => 'bank_sampah']);

        // Create Permissions
        $permissions = [
            // User Management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Wilayah
            'wilayah.view',
            'wilayah.create',
            'wilayah.edit',
            'wilayah.delete',

            // Bank Sampah
            'bank-sampah.view',
            'bank-sampah.create',
            'bank-sampah.edit',
            'bank-sampah.delete',

            // Jenis Sampah
            'jenis-sampah.view',
            'jenis-sampah.create',
            'jenis-sampah.edit',
            'jenis-sampah.delete',

            // Harga Standar
            'harga-standar.view',
            'harga-standar.create',
            'harga-standar.edit',
            'harga-standar.delete',

            // Harga Bank
            'harga-bank.view',
            'harga-bank.create',
            'harga-bank.edit',
            'harga-bank.delete',

            // Transaksi Penyetoran
            'penyetoran.view',
            'penyetoran.create',
            'penyetoran.edit',
            'penyetoran.delete',

            // Transaksi Penjualan
            'penjualan.view',
            'penjualan.create',
            'penjualan.edit',
            'penjualan.delete',

            // Dashboard & Monitoring
            'dashboard.admin',
            'dashboard.bank',
            'monitoring.view',

            // Laporan
            'laporan.view',
            'laporan.export',

            // Log Aktivitas
            'log.view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign Permissions to Admin (Full Access)
        $adminRole->givePermissionTo(Permission::all());

        // Assign Permissions to Bank Sampah (Limited Access)
        $bankSampahRole->givePermissionTo([
            'bank-sampah.view',
            'jenis-sampah.view',
            'harga-bank.view',
            'harga-bank.create',
            'harga-bank.edit',
            'penyetoran.view',
            'penyetoran.create',
            'penyetoran.edit',
            'penyetoran.delete',
            'penjualan.view',
            'penjualan.create',
            'penjualan.edit',
            'penjualan.delete',
            'dashboard.bank',
            'laporan.view',
            'laporan.export',
        ]);
    }
}
