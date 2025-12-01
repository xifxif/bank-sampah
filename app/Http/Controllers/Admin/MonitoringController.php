<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\HargaSampahBank;
use App\Models\JenisSampah;
use App\Models\LogAktivitas;
use App\Models\TransaksiPenyetoran;
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index()
    {
        return view('admin.monitoring.index');
    }

    /**
     * Monitoring Harga Sampah
     */
    public function harga()
    {
        $jenisSampah = JenisSampah::active()->get();

        $monitoringHarga = [];

        foreach ($jenisSampah as $jenis) {
            $hargaBank = HargaSampahBank::with('bankSampah')
                ->where('jenis_sampah_id', $jenis->id)
                ->latest('tanggal_berlaku')
                ->get()
                ->unique('bank_sampah_id');

            $monitoringHarga[] = [
                'jenis' => $jenis,
                'harga_standar' => $jenis->harga_standar,
                'harga_banks' => $hargaBank,
            ];
        }

        return view('admin.monitoring.harga', compact('monitoringHarga'));
    }

    /**
     * Monitoring Transaksi per Bank
     */
    public function transaksi(Request $request)
    {
        $query = BankSampah::with('wilayah');

        if ($request->filled('wilayah_id')) {
            $query->byWilayah($request->wilayah_id);
        }

        if ($request->filled('periode')) {
            switch ($request->periode) {
                case 'hari_ini':
                    $query->whereHas('transaksiPenyetoran', function ($q) {
                        $q->whereDate('tanggal_setor', today());
                    });
                    break;
                case 'minggu_ini':
                    $query->whereHas('transaksiPenyetoran', function ($q) {
                        $q->whereBetween('tanggal_setor', [now()->startOfWeek(), now()->endOfWeek()]);
                    });
                    break;
                case 'bulan_ini':
                    $query->whereHas('transaksiPenyetoran', function ($q) {
                        $q->whereMonth('tanggal_setor', date('m'))
                            ->whereYear('tanggal_setor', date('Y'));
                    });
                    break;
            }
        }

        $bankSampah = $query->withCount([
            'transaksiPenyetoran',
            'transaksiPenjualan'
        ])
            ->withSum('transaksiPenyetoran', 'berat')
            ->withSum('transaksiPenyetoran', 'subtotal')
            ->withSum('transaksiPenjualan', 'berat')
            ->withSum('transaksiPenjualan', 'subtotal')
            ->get();

        return view('admin.monitoring.transaksi', compact('bankSampah'));
    }

    /**
     * Monitoring Log Aktivitas
     */
    public function logAktivitas(Request $request)
    {
        $query = LogAktivitas::with(['user', 'bankSampah']);

        if ($request->filled('modul')) {
            $query->byModul($request->modul);
        }

        if ($request->filled('bank_sampah_id')) {
            $query->byBank($request->bank_sampah_id);
        }

        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->byDate($request->tanggal_dari, $request->tanggal_sampai);
        }

        $logs = $query->latest()->paginate(50);
        $bankSampah = BankSampah::active()->orderBy('nama_bank')->get();

        return view('admin.monitoring.log', compact('logs', 'bankSampah'));
    }

    /**
     * Monitoring Wilayah
     */
    public function wilayah()
    {
        $wilayah = \App\Models\Wilayah::withCount(['bankSampah', 'bankSampahAktif'])
            ->get()
            ->map(function ($item) {
                $totalPenyetoran = TransaksiPenyetoran::whereHas('bankSampah', function ($q) use ($item) {
                    $q->where('wilayah_id', $item->id);
                })->sum('subtotal');

                $totalPenjualan = TransaksiPenjualan::whereHas('bankSampah', function ($q) use ($item) {
                    $q->where('wilayah_id', $item->id);
                })->sum('subtotal');

                $item->total_nilai = $totalPenyetoran;
                $item->total_penjualan = $totalPenjualan;

                return $item;
            })
            ->sortByDesc('total_nilai');

        return view('admin.monitoring.wilayah', compact('wilayah'));
    }
}
