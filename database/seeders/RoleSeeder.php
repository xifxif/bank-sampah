<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $bankSampahRole = Role::firstOrCreate(['name' => 'bank_sampah']);

        // Create Permissions
        $permissions = [
            'user.view', 'user.create', 'user.edit', 'user.delete',
            'wilayah.view', 'wilayah.create', 'wilayah.edit', 'wilayah.delete',
            'bank-sampah.view', 'bank-sampah.create', 'bank-sampah.edit', 'bank-sampah.delete',
            'jenis-sampah.view', 'jenis-sampah.create', 'jenis-sampah.edit', 'jenis-sampah.delete',
            'harga-standar.view', 'harga-standar.create', 'harga-standar.edit', 'harga-standar.delete',
            'harga-bank.view', 'harga-bank.create', 'harga-bank.edit', 'harga-bank.delete',
            'penyetoran.view', 'penyetoran.create', 'penyetoran.edit', 'penyetoran.delete',
            'penjualan.view', 'penjualan.create', 'penjualan.edit', 'penjualan.delete',
            'dashboard.admin', 'dashboard.bank', 'monitoring.view',
            'laporan.view', 'laporan.export', 'log.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Sync permissions
        $adminRole->syncPermissions(Permission::all());
        $bankSampahRole->syncPermissions([
            'bank-sampah.view', 'jenis-sampah.view',
            'harga-bank.view', 'harga-bank.create', 'harga-bank.edit',
            'penyetoran.view', 'penyetoran.create', 'penyetoran.edit', 'penyetoran.delete',
            'penjualan.view', 'penjualan.create', 'penjualan.edit', 'penjualan.delete',
            'dashboard.bank', 'laporan.view', 'laporan.export',
        ]);
    }
}