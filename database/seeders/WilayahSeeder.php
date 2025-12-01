<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wilayah = [
            // Kecamatan Tasikmalaya (sample)
            [
                'kode_wilayah' => 'KEC-001',
                'nama_wilayah' => 'Kawalu',
                'jenis' => 'kecamatan',
                'keterangan' => 'Kecamatan Kawalu, Kota Tasikmalaya',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_wilayah' => 'KEC-002',
                'nama_wilayah' => 'Cihideung',
                'jenis' => 'kecamatan',
                'keterangan' => 'Kecamatan Cihideung, Kota Tasikmalaya',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_wilayah' => 'KEC-003',
                'nama_wilayah' => 'Cipedes',
                'jenis' => 'kecamatan',
                'keterangan' => 'Kecamatan Cipedes, Kota Tasikmalaya',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_wilayah' => 'KEC-004',
                'nama_wilayah' => 'Tawang',
                'jenis' => 'kecamatan',
                'keterangan' => 'Kecamatan Tawang, Kota Tasikmalaya',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_wilayah' => 'KEC-005',
                'nama_wilayah' => 'Mangkubumi',
                'jenis' => 'kecamatan',
                'keterangan' => 'Kecamatan Mangkubumi, Kota Tasikmalaya',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kelurahan
            [
                'kode_wilayah' => 'KEL-001',
                'nama_wilayah' => 'Setiawargi',
                'jenis' => 'kelurahan',
                'keterangan' => 'Kelurahan Setiawargi, Kecamatan Kawalu',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_wilayah' => 'KEL-002',
                'nama_wilayah' => 'Sukamanah',
                'jenis' => 'kelurahan',
                'keterangan' => 'Kelurahan Sukamanah, Kecamatan Cipedes',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_wilayah' => 'KEL-003',
                'nama_wilayah' => 'Kahuripan',
                'jenis' => 'kelurahan',
                'keterangan' => 'Kelurahan Kahuripan, Kecamatan Tawang',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_wilayah' => 'KEL-004',
                'nama_wilayah' => 'Parakannyasag',
                'jenis' => 'kelurahan',
                'keterangan' => 'Kelurahan Parakannyasag, Kecamatan Mangkubumi',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_wilayah' => 'KEL-005',
                'nama_wilayah' => 'Cibeureum',
                'jenis' => 'kelurahan',
                'keterangan' => 'Kelurahan Cibeureum, Kecamatan Cihideung',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('wilayah')->insert($wilayah);

        $this->command->info('✓ ' . count($wilayah) . ' wilayah berhasil dibuat!');
    }
}
