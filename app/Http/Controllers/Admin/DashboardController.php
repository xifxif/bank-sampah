<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\JenisSampah;
use App\Models\TransaksiPenyetoran;
use App\Models\TransaksiPenjualan;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Bank Sampah
        $totalBankSampah = BankSampah::count();
        $totalBankSampahAktif = BankSampah::active()->count();

        // Total Transaksi
        $totalPenyetoran = TransaksiPenyetoran::count();
        $totalPenjualan = TransaksiPenjualan::count();

        // Total Berat & Nilai
        $totalBeratPenyetoran = TransaksiPenyetoran::sum('berat');
        $totalNilaiPenyetoran = TransaksiPenyetoran::sum('subtotal');
        $totalBeratPenjualan = TransaksiPenjualan::sum('berat');
        $totalNilaiPenjualan = TransaksiPenjualan::sum('subtotal');

        // Transaksi Bulan Ini
        $penyetoranBulanIni = TransaksiPenyetoran::thisMonth()->count();
        $penjualanBulanIni = TransaksiPenjualan::thisMonth()->count();
        $nilaiPenyetoranBulanIni = TransaksiPenyetoran::thisMonth()->sum('subtotal');
        $nilaiPenjualanBulanIni = TransaksiPenjualan::thisMonth()->sum('subtotal');

        // Jenis Sampah Terbanyak (Top 5)
        $jenisSampahTerbanyak = TransaksiPenyetoran::select('jenis_sampah_id', DB::raw('SUM(berat) as total_berat'))
            ->groupBy('jenis_sampah_id')
            ->orderByDesc('total_berat')
            ->with('jenisSampah')
            ->limit(5)
            ->get();

        // Bank Sampah Paling Aktif (Top 10)
        $bankSampahAktif = BankSampah::withCount(['transaksiPenyetoran', 'transaksiPenjualan'])
            ->orderByDesc('transaksi_penyetoran_count')
            ->limit(10)
            ->get();

        // Nilai Ekonomis Per Wilayah
        $nilaiPerWilayah = Wilayah::withCount('bankSampah')
            ->get()
            ->map(function ($wilayah) {
                $totalNilai = TransaksiPenyetoran::whereHas('bankSampah', function ($q) use ($wilayah) {
                    $q->where('wilayah_id', $wilayah->id);
                })->sum('subtotal');

                $wilayah->total_nilai = $totalNilai;
                return $wilayah;
            })
            ->sortByDesc('total_nilai')
            ->take(10);

        // Chart Data - Transaksi 7 Hari Terakhir
        $chartData = $this->getChartData();

        return view('admin.dashboard', compact(
            'totalBankSampah',
            'totalBankSampahAktif',
            'totalPenyetoran',
            'totalPenjualan',
            'totalBeratPenyetoran',
            'totalNilaiPenyetoran',
            'totalBeratPenjualan',
            'totalNilaiPenjualan',
            'penyetoranBulanIni',
            'penjualanBulanIni',
            'nilaiPenyetoranBulanIni',
            'nilaiPenjualanBulanIni',
            'jenisSampahTerbanyak',
            'bankSampahAktif',
            'nilaiPerWilayah',
            'chartData'
        ));
    }

    private function getChartData()
    {
        $dates = [];
        $penyetoran = [];
        $penjualan = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates[] = now()->subDays($i)->format('d M');

            $penyetoran[] = TransaksiPenyetoran::whereDate('tanggal_setor', $date)->count();
            $penjualan[] = TransaksiPenjualan::whereDate('tanggal_jual', $date)->count();
        }

        return [
            'dates' => $dates,
            'penyetoran' => $penyetoran,
            'penjualan' => $penjualan,
        ];
    }
}
