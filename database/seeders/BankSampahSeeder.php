<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Wilayah;

class BankSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID wilayah dari tabel 'wilayah'
        $setiawargi = Wilayah::where('nama_wilayah', 'Setiawargi')->first()->id;
        $sukamanah = Wilayah::where('nama_wilayah', 'Sukamanah')->first()->id;
        $kahuripan = Wilayah::where('nama_wilayah', 'Kahuripan')->first()->id;
        $parakannyasag = Wilayah::where('nama_wilayah', 'Parakannyasag')->first()->id;
        $cibeureum = Wilayah::where('nama_wilayah', 'Cibeureum')->first()->id;

        $bankSampah = [
            [
                'wilayah_id' => $setiawargi,
                'kode_bank' => 'BS-001',
                'nama_bank' => 'Bank Sampah Berkah Lestari',
                'alamat' => 'Jl. Setiawargi No. 45, Kawalu, Tasikmalaya',
                'no_telepon' => '081234567801',
                'nama_pengelola' => 'Ibu Siti Nurjanah',
                'email' => 'berkahlestari@gmail.com',
                'tanggal_berdiri' => '2020-05-15',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah binaan DLH sejak 2020',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wilayah_id' => $sukamanah,
                'kode_bank' => 'BS-002',
                'nama_bank' => 'Bank Sampah Hijau Mandiri',
                'alamat' => 'Jl. Sukamanah Raya No. 12, Cipedes, Tasikmalaya',
                'no_telepon' => '081234567802',
                'nama_pengelola' => 'Bapak Ahmad Hidayat',
                'email' => 'hijaumandiri@gmail.com',
                'tanggal_berdiri' => '2019-08-20',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah percontohan wilayah Cipedes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wilayah_id' => $kahuripan,
                'kode_bank' => 'BS-003',
                'nama_bank' => 'Bank Sampah Sejahtera Bersama',
                'alamat' => 'Jl. Kahuripan Indah No. 78, Tawang, Tasikmalaya',
                'no_telepon' => '081234567803',
                'nama_pengelola' => 'Ibu Rika Wulandari',
                'email' => 'sejahterabersama@gmail.com',
                'tanggal_berdiri' => '2021-03-10',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah aktif dengan nasabah 150+ orang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wilayah_id' => $parakannyasag,
                'kode_bank' => 'BS-004',
                'nama_bank' => 'Bank Sampah Bumi Asri',
                'alamat' => 'Jl. Parakannyasag No. 25, Mangkubumi, Tasikmalaya',
                'no_telepon' => '081234567804',
                'nama_pengelola' => 'Bapak Dedi Supriadi',
                'email' => 'bumiasri@gmail.com',
                'tanggal_berdiri' => '2020-11-05',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah dengan program daur ulang kreatif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wilayah_id' => $cibeureum,
                'kode_bank' => 'BS-005',
                'nama_bank' => 'Bank Sampah Cibeureum Bersih',
                'alamat' => 'Jl. Cibeureum Utara No. 56, Cihideung, Tasikmalaya',
                'no_telepon' => '081234567805',
                'nama_pengelola' => 'Ibu Neni Setiani',
                'email' => 'cibeuреumbersih@gmail.com',
                'tanggal_berdiri' => '2022-01-20',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah baru dengan potensi besar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wilayah_id' => $setiawargi,
                'kode_bank' => 'BS-006',
                'nama_bank' => 'Bank Sampah Maju Bersama',
                'alamat' => 'Jl. Raya Kawalu No. 88, Kawalu, Tasikmalaya',
                'no_telepon' => '081234567806',
                'nama_pengelola' => 'Bapak Yanto Hermawan',
                'email' => 'majubersama@gmail.com',
                'tanggal_berdiri' => '2021-07-15',
                'status' => 'aktif',
                'keterangan' => 'Bank sampah dengan sistem digital sejak awal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wilayah_id' => $sukamanah,
                'kode_bank' => 'BS-007',
                'nama_bank' => 'Bank Sampah Peduli Lingkungan',
                'alamat' => 'Jl. Cipedes Selatan No. 33, Cipedes, Tasikmalaya',
                'no_telepon' => '081234567807',
                'nama_pengelola' => 'Ibu Euis Juariah',
                'email' => 'pedulilingkungan@gmail.com',
                'tanggal_berdiri' => '2020-09-30',
                'status' => 'aktif',
                'keterangan' => 'Fokus pada edukasi lingkungan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'wilayah_id' => $kahuripan,
                'kode_bank' => 'BS-008',
                'nama_bank' => 'Bank Sampah Harapan Kita',
                'alamat' => 'Jl. Tawang Raya No. 101, Tawang, Tasikmalaya',
                'no_telepon' => '081234567808',
                'nama_pengelola' => 'Bapak Ujang Soleh',
                'email' => 'harapankita@gmail.com',
                'tanggal_berdiri' => '2019-12-10',
                'status' => 'nonaktif',
                'keterangan' => 'Sedang dalam proses reaktivasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('bank_sampah')->insert($bankSampah);

        $this->command->info('✓ ' . count($bankSampah) . ' bank sampah berhasil dibuat!');
    }
}
