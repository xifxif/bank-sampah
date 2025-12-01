<?php

namespace App\Http\Controllers\BankSampah;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPenyetoran;
use App\Models\TransaksiPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Index laporan
     */
    public function index()
    {
        return view('bank-sampah.laporan.index');
    }

    /**
     * Laporan Harian
     */
    public function harian(Request $request)
    {
        $bankSampahId = Auth::user()->bank_sampah_id;
        $bankSampah = Auth::user()->bankSampah;

        $request->validate([
            'tanggal' => ['required', 'date'],
        ]);

        $tanggal = $request->tanggal;

        $penyetoran = TransaksiPenyetoran::with('jenisSampah')
            ->byBank($bankSampahId)
            ->whereDate('tanggal_setor', $tanggal)
            ->orderBy('created_at')
            ->get();

        $penjualan = TransaksiPenjualan::with('jenisSampah')
            ->byBank($bankSampahId)
            ->whereDate('tanggal_jual', $tanggal)
            ->orderBy('created_at')
            ->get();

        $summary = [
            'total_penyetoran' => $penyetoran->count(),
            'total_berat_penyetoran' => $penyetoran->sum('berat'),
            'total_nilai_penyetoran' => $penyetoran->sum('subtotal'),
            'total_penjualan' => $penjualan->count(),
            'total_berat_penjualan' => $penjualan->sum('berat'),
            'total_nilai_penjualan' => $penjualan->sum('subtotal'),
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('bank-sampah.laporan.pdf.harian', compact(
                'penyetoran',
                'penjualan',
                'summary',
                'tanggal',
                'bankSampah'
            ));

            return $pdf->download('laporan-harian-' . $tanggal . '.pdf');
        }

        return view('bank-sampah.laporan.harian', compact(
            'penyetoran',
            'penjualan',
            'summary',
            'tanggal'
        ));
    }

    /**
     * Laporan Periode
     */
    public function periode(Request $request)
    {
        $bankSampahId = Auth::user()->bank_sampah_id;
        $bankSampah = Auth::user()->bankSampah;

        $request->validate([
            'tanggal_dari' => ['required', 'date'],
            'tanggal_sampai' => ['required', 'date', 'after_or_equal:tanggal_dari'],
        ]);

        $penyetoran = TransaksiPenyetoran::with('jenisSampah')
            ->byBank($bankSampahId)
            ->byDate($request->tanggal_dari, $request->tanggal_sampai)
            ->orderBy('tanggal_setor')
            ->get();

        $penjualan = TransaksiPenjualan::with('jenisSampah')
            ->byBank($bankSampahId)
            ->byDate($request->tanggal_dari, $request->tanggal_sampai)
            ->orderBy('tanggal_jual')
            ->get();

        $summary = [
            'total_penyetoran' => $penyetoran->count(),
            'total_berat_penyetoran' => $penyetoran->sum('berat'),
            'total_nilai_penyetoran' => $penyetoran->sum('subtotal'),
            'total_penjualan' => $penjualan->count(),
            'total_berat_penjualan' => $penjualan->sum('berat'),
            'total_nilai_penjualan' => $penjualan->sum('subtotal'),
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('bank-sampah.laporan.pdf.periode', compact(
                'penyetoran',
                'penjualan',
                'summary',
                'request',
                'bankSampah'
            ));

            $filename = 'laporan-periode-' . $request->tanggal_dari . '-' . $request->tanggal_sampai . '.pdf';
            return $pdf->download($filename);
        }

        return view('bank-sampah.laporan.periode', compact(
            'penyetoran',
            'penjualan',
            'summary'
        ));
    }

    /**
     * Laporan Bulanan
     */
    public function bulanan(Request $request)
    {
        $bankSampahId = Auth::user()->bank_sampah_id;
        $bankSampah = Auth::user()->bankSampah;

        $request->validate([
            'bulan' => ['required', 'integer', 'between:1,12'],
            'tahun' => ['required', 'integer', 'min:2000'],
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $penyetoran = TransaksiPenyetoran::with('jenisSampah')
            ->byBank($bankSampahId)
            ->whereMonth('tanggal_setor', $bulan)
            ->whereYear('tanggal_setor', $tahun)
            ->orderBy('tanggal_setor')
            ->get();

        $penjualan = TransaksiPenjualan::with('jenisSampah')
            ->byBank($bankSampahId)
            ->whereMonth('tanggal_jual', $bulan)
            ->whereYear('tanggal_jual', $tahun)
            ->orderBy('tanggal_jual')
            ->get();

        // Group by jenis sampah
        $penyetoranPerJenis = $penyetoran->groupBy('jenis_sampah_id')
            ->map(function ($items) {
                return [
                    'jenis' => $items->first()->jenisSampah,
                    'total_berat' => $items->sum('berat'),
                    'total_nilai' => $items->sum('subtotal'),
                    'total_transaksi' => $items->count(),
                ];
            });

        $summary = [
            'total_penyetoran' => $penyetoran->count(),
            'total_berat_penyetoran' => $penyetoran->sum('berat'),
            'total_nilai_penyetoran' => $penyetoran->sum('subtotal'),
            'total_penjualan' => $penjualan->count(),
            'total_berat_penjualan' => $penjualan->sum('berat'),
            'total_nilai_penjualan' => $penjualan->sum('subtotal'),
        ];

        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('bank-sampah.laporan.pdf.bulanan', compact(
                'penyetoran',
                'penjualan',
                'penyetoranPerJenis',
                'summary',
                'bulan',
                'tahun',
                'namaBulan',
                'bankSampah'
            ));

            $filename = 'laporan-bulanan-' . $namaBulan[$bulan] . '-' . $tahun . '.pdf';
            return $pdf->download($filename);
        }

        return view('bank-sampah.laporan.bulanan', compact(
            'penyetoran',
            'penjualan',
            'penyetoranPerJenis',
            'summary',
            'bulan',
            'tahun',
            'namaBulan'
        ));
    }

    /**
     * Laporan Tahunan
     */
    public function tahunan(Request $request)
    {
        $bankSampahId = Auth::user()->bank_sampah_id;
        $bankSampah = Auth::user()->bankSampah;

        $request->validate([
            'tahun' => ['required', 'integer', 'min:2000'],
        ]);

        $tahun = $request->tahun;

        // Data per bulan
        $dataBulanan = [];
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $penyetoran = TransaksiPenyetoran::byBank($bankSampahId)
                ->whereMonth('tanggal_setor', $bulan)
                ->whereYear('tanggal_setor', $tahun)
                ->get();

            $penjualan = TransaksiPenjualan::byBank($bankSampahId)
                ->whereMonth('tanggal_jual', $bulan)
                ->whereYear('tanggal_jual', $tahun)
                ->get();

            $dataBulanan[] = [
                'bulan' => $bulan,
                'total_penyetoran' => $penyetoran->count(),
                'total_berat_penyetoran' => $penyetoran->sum('berat'),
                'total_nilai_penyetoran' => $penyetoran->sum('subtotal'),
                'total_penjualan' => $penjualan->count(),
                'total_berat_penjualan' => $penjualan->sum('berat'),
                'total_nilai_penjualan' => $penjualan->sum('subtotal'),
            ];
        }

        // Summary tahunan
        $summary = [
            'total_penyetoran' => array_sum(array_column($dataBulanan, 'total_penyetoran')),
            'total_berat_penyetoran' => array_sum(array_column($dataBulanan, 'total_berat_penyetoran')),
            'total_nilai_penyetoran' => array_sum(array_column($dataBulanan, 'total_nilai_penyetoran')),
            'total_penjualan' => array_sum(array_column($dataBulanan, 'total_penjualan')),
            'total_berat_penjualan' => array_sum(array_column($dataBulanan, 'total_berat_penjualan')),
            'total_nilai_penjualan' => array_sum(array_column($dataBulanan, 'total_nilai_penjualan')),
        ];

        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('bank-sampah.laporan.pdf.tahunan', compact(
                'dataBulanan',
                'summary',
                'tahun',
                'namaBulan',
                'bankSampah'
            ));

            return $pdf->download('laporan-tahunan-' . $tahun . '.pdf');
        }

        return view('bank-sampah.laporan.tahunan', compact(
            'dataBulanan',
            'summary',
            'tahun',
            'namaBulan'
        ));
    }

    /**
     * Laporan Jenis Sampah
     */
    public function jenisSampah(Request $request)
    {
        $bankSampahId = Auth::user()->bank_sampah_id;
        $bankSampah = Auth::user()->bankSampah;

        $request->validate([
            'tanggal_dari' => ['required', 'date'],
            'tanggal_sampai' => ['required', 'date', 'after_or_equal:tanggal_dari'],
        ]);

        $data = TransaksiPenyetoran::select(
            'jenis_sampah_id',
            DB::raw('SUM(berat) as total_berat'),
            DB::raw('SUM(subtotal) as total_nilai'),
            DB::raw('COUNT(*) as total_transaksi')
        )
            ->byBank($bankSampahId)
            ->byDate($request->tanggal_dari, $request->tanggal_sampai)
            ->groupBy('jenis_sampah_id')
            ->with('jenisSampah')
            ->orderByDesc('total_nilai')
            ->get();

        $summary = [
            'total_jenis' => $data->count(),
            'total_berat' => $data->sum('total_berat'),
            'total_nilai' => $data->sum('total_nilai'),
            'total_transaksi' => $data->sum('total_transaksi'),
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('bank-sampah.laporan.pdf.jenis-sampah', compact(
                'data',
                'summary',
                'request',
                'bankSampah'
            ));

            return $pdf->download('laporan-jenis-sampah-' . date('Y-m-d') . '.pdf');
        }

        return view('bank-sampah.laporan.jenis-sampah', compact(
            'data',
            'summary'
        ));
    }
}
