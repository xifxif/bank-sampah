<?php

namespace App\Http\Controllers\BankSampah;

use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\DB;
use App\Models\TransaksiPenyetoran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bankSampahId = Auth::user()->bank_sampah_id;

        // Total Transaksi
        $totalPenyetoran = TransaksiPenyetoran::byBank($bankSampahId)->count();
        $totalPenjualan = TransaksiPenjualan::byBank($bankSampahId)->count();

        // Total Berat & Nilai
        $totalBeratPenyetoran = TransaksiPenyetoran::byBank($bankSampahId)->sum('berat');
        $totalNilaiPenyetoran = TransaksiPenyetoran::byBank($bankSampahId)->sum('subtotal');
        $totalBeratPenjualan = TransaksiPenjualan::byBank($bankSampahId)->sum('berat');
        $totalNilaiPenjualan = TransaksiPenjualan::byBank($bankSampahId)->sum('subtotal');

        // Transaksi Bulan Ini
        $penyetoranBulanIni = TransaksiPenyetoran::byBank($bankSampahId)->thisMonth()->count();
        $penjualanBulanIni = TransaksiPenjualan::byBank($bankSampahId)->thisMonth()->count();
        $nilaiPenyetoranBulanIni = TransaksiPenyetoran::byBank($bankSampahId)->thisMonth()->sum('subtotal');
        $nilaiPenjualanBulanIni = TransaksiPenjualan::byBank($bankSampahId)->thisMonth()->sum('subtotal');

        // Jenis Sampah Terbanyak (Top 5)
        $jenisSampahTerbanyak = TransaksiPenyetoran::byBank($bankSampahId)
            ->select('jenis_sampah_id', DB::raw('SUM(berat) as total_berat'))
            ->groupBy('jenis_sampah_id')
            ->orderByDesc('total_berat')
            ->with('jenisSampah')
            ->limit(5)
            ->get();

        // Transaksi Terbaru
        $transaksiTerbaru = TransaksiPenyetoran::byBank($bankSampahId)
            ->with('jenisSampah')
            ->latest()
            ->limit(10)
            ->get();

        // Chart Data - Transaksi 7 Hari Terakhir
        $chartData = $this->getChartData($bankSampahId);

        return view('bank-sampah.dashboard', compact(
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
            'transaksiTerbaru',
            'chartData'
        ));
    }

    private function getChartData($bankSampahId)
    {
        $dates = [];
        $penyetoran = [];
        $penjualan = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates[] = now()->subDays($i)->format('d M');

            $penyetoran[] = TransaksiPenyetoran::byBank($bankSampahId)
                ->whereDate('tanggal_setor', $date)
                ->count();

            $penjualan[] = TransaksiPenjualan::byBank($bankSampahId)
                ->whereDate('tanggal_jual', $date)
                ->count();
        }

        return [
            'dates' => $dates,
            'penyetoran' => $penyetoran,
            'penjualan' => $penjualan,
        ];
    }
}
