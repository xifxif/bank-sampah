<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\JenisSampah;
use App\Models\TransaksiPenyetoran;
use App\Models\TransaksiPenjualan;
use App\Models\Wilayah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Index laporan
     */
    public function index()
    {
        return view('admin.laporan.index');
    }

    /**
     * Laporan Transaksi
     */
    public function transaksi(Request $request)
    {
        // Jika belum ada parameter, tampilkan form kosong
        if (!$request->has('tanggal_dari') || !$request->has('tanggal_sampai')) {
            $bankSampahList = BankSampah::orderBy('nama')->get();
            $jenisSampahList = JenisSampah::orderBy('nama')->get();
            return view('admin.laporan.transaksi', compact('bankSampahList', 'jenisSampahList'));
        }

        $request->validate([
            'tanggal_dari' => ['required', 'date'],
            'tanggal_sampai' => ['required', 'date', 'after_or_equal:tanggal_dari'],
            'bank_sampah_id' => ['nullable', 'exists:bank_sampah,id'],
            'jenis_sampah_id' => ['nullable', 'exists:jenis_sampah,id'],
        ]);

        $queryPenyetoran = TransaksiPenyetoran::with(['bankSampah', 'jenisSampah'])
            ->byDate($request->tanggal_dari, $request->tanggal_sampai);

        $queryPenjualan = TransaksiPenjualan::with(['bankSampah', 'jenisSampah'])
            ->byDate($request->tanggal_dari, $request->tanggal_sampai);

        if ($request->filled('bank_sampah_id')) {
            $queryPenyetoran->byBank($request->bank_sampah_id);
            $queryPenjualan->byBank($request->bank_sampah_id);
        }

        if ($request->filled('jenis_sampah_id')) {
            $queryPenyetoran->where('jenis_sampah_id', $request->jenis_sampah_id);
            $queryPenjualan->where('jenis_sampah_id', $request->jenis_sampah_id);
        }

        $penyetoran = $queryPenyetoran->orderBy('tanggal_setor')->get();
        $penjualan = $queryPenjualan->orderBy('tanggal_jual')->get();

        $summary = [
            'total_penyetoran' => $penyetoran->count(),
            'total_berat_penyetoran' => $penyetoran->sum('berat'),
            'total_nilai_penyetoran' => $penyetoran->sum('subtotal'),
            'total_penjualan' => $penjualan->count(),
            'total_berat_penjualan' => $penjualan->sum('berat'),
            'total_nilai_penjualan' => $penjualan->sum('subtotal'),
        ];

        $bankSampahList = BankSampah::orderBy('nama')->get();
        $jenisSampahList = JenisSampah::orderBy('nama')->get();
        $selectedBank = $request->filled('bank_sampah_id')
            ? BankSampah::find($request->bank_sampah_id)
            : null;

        if ($request->has('download')) {
            $pdf = PDF::loadView('admin.laporan.pdf.transaksi', compact(
                'penyetoran',
                'penjualan',
                'summary',
                'selectedBank',
                'request'
            ));

            return $pdf->download('laporan-transaksi-' . date('Y-m-d') . '.pdf');
        }

        return view('admin.laporan.transaksi', compact(
            'penyetoran',
            'penjualan',
            'summary',
            'bankSampahList',
            'jenisSampahList',
            'selectedBank'
        ));
    }

    /**
     * Laporan Jenis Sampah
     */
    public function jenisSampah(Request $request)
    {
        // Jika belum ada parameter, tampilkan form kosong
        if (!$request->has('tanggal_dari') || !$request->has('tanggal_sampai')) {
            return view('admin.laporan.jenis-sampah');
        }

        $request->validate([
            'tanggal_dari' => ['required', 'date'],
            'tanggal_sampai' => ['required', 'date', 'after_or_equal:tanggal_dari'],
        ]);

        $jenisSampah = JenisSampah::active()
            ->get()
            ->map(function ($jenis) use ($request) {
                $transaksi = $jenis->transaksiPenyetoran()
                    ->byDate($request->tanggal_dari, $request->tanggal_sampai)
                    ->get();

                $jenis->transaksi_count = $transaksi->count();
                $jenis->total_berat = $transaksi->sum('berat');
                $jenis->total_nilai = $transaksi->sum('subtotal');

                return $jenis;
            })
            ->sortByDesc('total_berat');

        $summary = [
            'total_berat' => $jenisSampah->sum('total_berat'),
            'total_nilai' => $jenisSampah->sum('total_nilai'),
            'total_transaksi' => $jenisSampah->sum('transaksi_count'),
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('admin.laporan.pdf.jenis-sampah', compact(
                'jenisSampah',
                'summary',
                'request'
            ));

            return $pdf->download('laporan-jenis-sampah-' . date('Y-m-d') . '.pdf');
        }

        return view('admin.laporan.jenis-sampah', compact('jenisSampah', 'summary'));
    }

    /**
     * Laporan Per Bank Sampah
     */
    public function perBank(Request $request)
    {
        // Jika belum ada parameter, tampilkan form kosong
        if (!$request->has('tanggal_dari') || !$request->has('tanggal_sampai')) {
            $wilayahList = Wilayah::orderBy('nama')->get();
            return view('admin.laporan.per-bank', compact('wilayahList'));
        }

        $request->validate([
            'tanggal_dari' => ['required', 'date'],
            'tanggal_sampai' => ['required', 'date', 'after_or_equal:tanggal_dari'],
            'wilayah_id' => ['nullable', 'exists:wilayah,id'],
        ]);

        $query = BankSampah::with('wilayah');

        if ($request->filled('wilayah_id')) {
            $query->byWilayah($request->wilayah_id);
        }

        $bankSampah = $query->get()
            ->map(function ($bank) use ($request) {
                $penyetoran = $bank->transaksiPenyetoran()
                    ->byDate($request->tanggal_dari, $request->tanggal_sampai)
                    ->get();

                $bank->transaksi_count = $penyetoran->count();
                $bank->total_berat = $penyetoran->sum('berat');
                $bank->total_nilai = $penyetoran->sum('subtotal');

                return $bank;
            })
            ->sortByDesc('total_nilai');

        $summary = [
            'total_bank' => $bankSampah->count(),
            'total_berat' => $bankSampah->sum('total_berat'),
            'total_nilai' => $bankSampah->sum('total_nilai'),
            'total_transaksi' => $bankSampah->sum('transaksi_count'),
        ];

        $wilayahList = Wilayah::orderBy('nama')->get();

        if ($request->has('download')) {
            $pdf = PDF::loadView('admin.laporan.pdf.per-bank', compact(
                'bankSampah',
                'summary',
                'request'
            ));

            return $pdf->download('laporan-per-bank-' . date('Y-m-d') . '.pdf');
        }

        return view('admin.laporan.per-bank', compact('bankSampah', 'summary', 'wilayahList'));
    }

    /**
     * Laporan Per Wilayah
     */
    public function perWilayah(Request $request)
    {
        // Jika belum ada parameter, tampilkan form kosong
        if (!$request->has('tanggal_dari') || !$request->has('tanggal_sampai')) {
            return view('admin.laporan.per-wilayah');
        }

        $request->validate([
            'tanggal_dari' => ['required', 'date'],
            'tanggal_sampai' => ['required', 'date', 'after_or_equal:tanggal_dari'],
        ]);

        $wilayah = Wilayah::withCount('bankSampah')
            ->get()
            ->map(function ($w) use ($request) {
                $totalPenyetoran = TransaksiPenyetoran::whereHas('bankSampah', function ($q) use ($w) {
                    $q->where('wilayah_id', $w->id);
                })
                    ->byDate($request->tanggal_dari, $request->tanggal_sampai)
                    ->sum('subtotal');

                $totalBerat = TransaksiPenyetoran::whereHas('bankSampah', function ($q) use ($w) {
                    $q->where('wilayah_id', $w->id);
                })
                    ->byDate($request->tanggal_dari, $request->tanggal_sampai)
                    ->sum('berat');

                $totalTransaksi = TransaksiPenyetoran::whereHas('bankSampah', function ($q) use ($w) {
                    $q->where('wilayah_id', $w->id);
                })
                    ->byDate($request->tanggal_dari, $request->tanggal_sampai)
                    ->count();

                $w->total_penyetoran = $totalPenyetoran;
                $w->total_berat = $totalBerat;
                $w->total_transaksi = $totalTransaksi;

                return $w;
            })
            ->sortByDesc('total_penyetoran');

        $summary = [
            'total_wilayah' => $wilayah->count(),
            'total_bank' => $wilayah->sum('bank_sampah_count'),
            'total_berat' => $wilayah->sum('total_berat'),
            'total_nilai' => $wilayah->sum('total_penyetoran'),
            'total_transaksi' => $wilayah->sum('total_transaksi'),
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('admin.laporan.pdf.per-wilayah', compact(
                'wilayah',
                'summary',
                'request'
            ));

            return $pdf->download('laporan-per-wilayah-' . date('Y-m-d') . '.pdf');
        }

        return view('admin.laporan.per-wilayah', compact('wilayah', 'summary'));
    }

    /**
     * Laporan Nilai Ekonomis
     */
    public function nilaiEkonomis(Request $request)
    {
        // Jika belum ada parameter, tampilkan form kosong
        if (!$request->has('tanggal_dari') || !$request->has('tanggal_sampai')) {
            return view('admin.laporan.nilai-ekonomis');
        }

        $request->validate([
            'tanggal_dari' => ['required', 'date'],
            'tanggal_sampai' => ['required', 'date', 'after_or_equal:tanggal_dari'],
        ]);

        // Group by kategori
        $perKategori = TransaksiPenyetoran::select(
            'jenis_sampah.kategori',
            DB::raw('SUM(transaksi_penyetoran.berat) as total_berat'),
            DB::raw('SUM(transaksi_penyetoran.subtotal) as total_nilai'),
            DB::raw('COUNT(*) as total_transaksi')
        )
            ->join('jenis_sampah', 'transaksi_penyetoran.jenis_sampah_id', '=', 'jenis_sampah.id')
            ->byDate($request->tanggal_dari, $request->tanggal_sampai)
            ->groupBy('jenis_sampah.kategori')
            ->get();

        // Group by jenis sampah
        $perJenis = TransaksiPenyetoran::select(
            'jenis_sampah_id',
            DB::raw('SUM(berat) as total_berat'),
            DB::raw('SUM(subtotal) as total_nilai'),
            DB::raw('COUNT(*) as total_transaksi')
        )
            ->byDate($request->tanggal_dari, $request->tanggal_sampai)
            ->groupBy('jenis_sampah_id')
            ->with('jenisSampah')
            ->orderByDesc('total_nilai')
            ->get();

        $summary = [
            'total_berat' => $perJenis->sum('total_berat'),
            'total_nilai' => $perJenis->sum('total_nilai'),
            'total_transaksi' => $perJenis->sum('total_transaksi'),
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('admin.laporan.pdf.nilai-ekonomis', compact(
                'perKategori',
                'perJenis',
                'summary',
                'request'
            ));

            return $pdf->download('laporan-nilai-ekonomis-' . date('Y-m-d') . '.pdf');
        }

        return view('admin.laporan.nilai-ekonomis', compact(
            'perKategori',
            'perJenis',
            'summary'
        ));
    }
}
