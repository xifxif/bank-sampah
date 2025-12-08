<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankSampah;
use App\Models\Wilayah;

class BankSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID wilayah dari tabel 'wilayah'
        $setiawargi = Wilayah::where('nama_wilayah', 'Setiawargi')->first();
        $sukamanah = Wilayah::where('nama_wilayah', 'Sukamanah')->first();
        $kahuripan = Wilayah::where('nama_wilayah', 'Kahuripan')->first();
        $parakannyasag = Wilayah::where('nama_wilayah', 'Parakannyasag')->first();
        $cibeureum = Wilayah::where('nama_wilayah', 'Cibeureum')->first();

        // Cek jika wilayah tidak ada
        if (!$setiawargi || !$sukamanah || !$kahuripan || !$parakannyasag || !$cibeureum) {
            $this->command->warn('⚠ Wilayah belum lengkap, pastikan WilayahSeeder sudah dijalankan!');
            return;
        }

        $bankSampahData = [
            [
                'wilayah_id' => $setiawargi->id,
                'kode_bank' => 'BS-001',
                'nama_bank' => 'Bank Sampah Berkah Lestari',
                'alamat' => 'Jl. Setiawargi No. 45, Kawalu, Tasikmalaya',
                'no_telepon' => '081234567801',
                'nama_pengelola' => 'Ibu Siti Nurjanah',
                'email' => 'berkahlestari@gmail.com',
                'tanggal_berdiri' => '2020-05-15',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah binaan DLH sejak 2020',
            ],
            [
                'wilayah_id' => $sukamanah->id,
                'kode_bank' => 'BS-002',
                'nama_bank' => 'Bank Sampah Hijau Mandiri',
                'alamat' => 'Jl. Sukamanah Raya No. 12, Cipedes, Tasikmalaya',
                'no_telepon' => '081234567802',
                'nama_pengelola' => 'Bapak Ahmad Hidayat',
                'email' => 'hijaumandiri@gmail.com',
                'tanggal_berdiri' => '2019-08-20',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah percontohan wilayah Cipedes',
            ],
            [
                'wilayah_id' => $kahuripan->id,
                'kode_bank' => 'BS-003',
                'nama_bank' => 'Bank Sampah Sejahtera Bersama',
                'alamat' => 'Jl. Kahuripan Indah No. 78, Tawang, Tasikmalaya',
                'no_telepon' => '081234567803',
                'nama_pengelola' => 'Ibu Rika Wulandari',
                'email' => 'sejahterabersama@gmail.com',
                'tanggal_berdiri' => '2021-03-10',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah aktif dengan nasabah 150+ orang',
            ],
            [
                'wilayah_id' => $parakannyasag->id,
                'kode_bank' => 'BS-004',
                'nama_bank' => 'Bank Sampah Bumi Asri',
                'alamat' => 'Jl. Parakannyasag No. 25, Mangkubumi, Tasikmalaya',
                'no_telepon' => '081234567804',
                'nama_pengelola' => 'Bapak Dedi Supriadi',
                'email' => 'bumiasri@gmail.com',
                'tanggal_berdiri' => '2020-11-05',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah dengan program daur ulang kreatif',
            ],
            [
                'wilayah_id' => $cibeureum->id,
                'kode_bank' => 'BS-005',
                'nama_bank' => 'Bank Sampah Cibeureum Bersih',
                'alamat' => 'Jl. Cibeureum Utara No. 56, Cihideung, Tasikmalaya',
                'no_telepon' => '081234567805',
                'nama_pengelola' => 'Ibu Neni Setiani',
                'email' => 'cibeureumbersih@gmail.com',
                'tanggal_berdiri' => '2022-01-20',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah baru dengan potensi besar',
            ],
            [
                'wilayah_id' => $setiawargi->id,
                'kode_bank' => 'BS-006',
                'nama_bank' => 'Bank Sampah Maju Bersama',
                'alamat' => 'Jl. Raya Kawalu No. 88, Kawalu, Tasikmalaya',
                'no_telepon' => '081234567806',
                'nama_pengelola' => 'Bapak Yanto Hermawan',
                'email' => 'majubersama@gmail.com',
                'tanggal_berdiri' => '2021-07-15',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah dengan sistem digital sejak awal',
            ],
            [
                'wilayah_id' => $sukamanah->id,
                'kode_bank' => 'BS-007',
                'nama_bank' => 'Bank Sampah Peduli Lingkungan',
                'alamat' => 'Jl. Cipedes Selatan No. 33, Cipedes, Tasikmalaya',
                'no_telepon' => '081234567807',
                'nama_pengelola' => 'Ibu Euis Juariah',
                'email' => 'pedulilingkungan@gmail.com',
                'tanggal_berdiri' => '2020-09-30',
                'status' => 'aktif',
                'keterangan' => 'Fokus pada edukasi lingkungan',
            ],
            [
                'wilayah_id' => $kahuripan->id,
                'kode_bank' => 'BS-008',
                'nama_bank' => 'Bank Sampah Harapan Kita',
                'alamat' => 'Jl. Tawang Raya No. 101, Tawang, Tasikmalaya',
                'no_telepon' => '081234567808',
                'nama_pengelola' => 'Bapak Ujang Soleh',
                'email' => 'harapankita@gmail.com',
                'tanggal_berdiri' => '2019-12-10',
                'status' => 'nonaktif',
                'keterangan' => 'Sedang dalam proses reaktivasi',
            ],
        ];

        foreach ($bankSampahData as $bank) {
            BankSampah::firstOrCreate(
                ['kode_bank' => $bank['kode_bank']],
                $bank
            );
        }

        $this->command->info('✓ ' . count($bankSampahData) . ' bank sampah berhasil dibuat!');
    }
}