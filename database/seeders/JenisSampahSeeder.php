<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSampah;

class JenisSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisSampahData = [
            // Plastik
            [
                'kode_jenis' => 'PLT-001',
                'nama_jenis' => 'Plastik PET (Botol Minuman)',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 3000,
                'keterangan' => 'Botol plastik bekas minuman kemasan',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'PLT-002',
                'nama_jenis' => 'Plastik PP (Ember, Gelas)',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 2500,
                'keterangan' => 'Plastik keras seperti ember dan gelas plastik',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'PLT-003',
                'nama_jenis' => 'Plastik HD (Kresek)',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 1500,
                'keterangan' => 'Plastik kresek dan kantong belanja',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'PLT-004',
                'nama_jenis' => 'Plastik Campur',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 1000,
                'keterangan' => 'Plastik berbagai jenis (campur)',
                'is_active' => true,
            ],

            // Kertas & Kardus
            [
                'kode_jenis' => 'KRT-001',
                'nama_jenis' => 'Kardus Cokelat',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 1800,
                'keterangan' => 'Kardus bekas kemasan berwarna cokelat',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'KRT-002',
                'nama_jenis' => 'Kardus Putih/Duplex',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 2000,
                'keterangan' => 'Kardus putih atau duplex bekas kemasan',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'KRT-003',
                'nama_jenis' => 'Kertas HVS/Buku',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 2500,
                'keterangan' => 'Kertas HVS bekas, buku tulis, fotokopian',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'KRT-004',
                'nama_jenis' => 'Kertas Koran',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 1500,
                'keterangan' => 'Koran bekas',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'KRT-005',
                'nama_jenis' => 'Kertas Campur',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 1000,
                'keterangan' => 'Kertas berbagai jenis (campur)',
                'is_active' => true,
            ],

            // Logam
            [
                'kode_jenis' => 'LGM-001',
                'nama_jenis' => 'Besi/Kaleng',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 2000,
                'keterangan' => 'Kaleng bekas dan besi tua',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'LGM-002',
                'nama_jenis' => 'Aluminium',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 7000,
                'keterangan' => 'Aluminium bekas (kaleng softdrink, dll)',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'LGM-003',
                'nama_jenis' => 'Tembaga',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 45000,
                'keterangan' => 'Tembaga bekas kabel atau peralatan',
                'is_active' => true,
            ],

            // Kaca
            [
                'kode_jenis' => 'KCA-001',
                'nama_jenis' => 'Botol Kaca Bening',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 500,
                'keterangan' => 'Botol kaca bening bekas kemasan',
                'is_active' => true,
            ],
            [
                'kode_jenis' => 'KCA-002',
                'nama_jenis' => 'Botol Kaca Warna',
                'kategori' => 'anorganik',
                'satuan' => 'kg',
                'harga_standar' => 400,
                'keterangan' => 'Botol kaca berwarna bekas kemasan',
                'is_active' => true,
            ],

            // Elektronik
            [
                'kode_jenis' => 'ELK-001',
                'nama_jenis' => 'Elektronik Bekas',
                'kategori' => 'b3',
                'satuan' => 'unit',
                'harga_standar' => 5000,
                'keterangan' => 'Peralatan elektronik bekas (harga per unit)',
                'is_active' => true,
            ],

            // Organik
            [
                'kode_jenis' => 'ORG-001',
                'nama_jenis' => 'Sampah Organik (Kompos)',
                'kategori' => 'organik',
                'satuan' => 'kg',
                'harga_standar' => 500,
                'keterangan' => 'Sampah organik untuk kompos',
                'is_active' => true,
            ],
        ];

        foreach ($jenisSampahData as $jenis) {
            JenisSampah::firstOrCreate(
                ['kode_jenis' => $jenis['kode_jenis']],
                $jenis
            );
        }

        $this->command->info('✓ ' . count($jenisSampahData) . ' jenis sampah berhasil dibuat!');
    }
}