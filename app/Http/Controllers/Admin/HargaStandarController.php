<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class HargaStandarController extends Controller
{
    /**
     * Display a listing of harga standar
     */
    public function index(Request $request)
    {
        $query = JenisSampah::query();

        if ($request->filled('kategori')) {
            $query->kategori($request->kategori);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_jenis', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_jenis', 'like', '%' . $request->search . '%');
            });
        }

        $jenisSampah = $query->orderBy('kategori')->orderBy('nama_jenis')->paginate(20);

        return view('admin.harga-standar.index', compact('jenisSampah'));
    }

    /**
     * Show the form for editing harga standar
     */
    public function edit(JenisSampah $jenisSampah)
    {
        return view('admin.harga-standar.edit', compact('jenisSampah'));
    }

    /**
     * Update harga standar
     */
    public function update(Request $request, JenisSampah $jenisSampah)
    {
        $request->validate([
            'harga_standar' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $oldHarga = $jenisSampah->harga_standar;
        $oldData = [
            'jenis_sampah' => $jenisSampah->nama_jenis,
            'harga_standar_lama' => $oldHarga,
            'harga_standar_baru' => $request->harga_standar,
        ];

        $jenisSampah->update([
            'harga_standar' => $request->harga_standar,
            'keterangan' => $request->keterangan,
        ]);

        LogAktivitas::logUpdate(
            'harga_standar',
            'Harga standar diupdate: ' . $jenisSampah->nama_jenis . ' dari Rp ' . number_format($oldHarga, 0, ',', '.') . ' ke Rp ' . number_format($request->harga_standar, 0, ',', '.'),
            $oldData,
            $jenisSampah->fresh()->toArray()
        );

        return redirect()->route('admin.harga-standar.index')
            ->with('success', 'Harga standar berhasil diupdate.');
    }

    /**
     * Bulk update harga standar
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'jenis_sampah_ids' => ['required', 'array'],
            'jenis_sampah_ids.*' => ['exists:jenis_sampah,id'],
            'persentase' => ['required', 'numeric', 'min:-100', 'max:1000'],
        ]);

        $jenisSampahList = JenisSampah::whereIn('id', $request->jenis_sampah_ids)->get();

        $updated = 0;
        foreach ($jenisSampahList as $jenis) {
            $oldHarga = $jenis->harga_standar;
            $newHarga = $oldHarga + ($oldHarga * ($request->persentase / 100));

            $jenis->update([
                'harga_standar' => $newHarga,
            ]);

            LogAktivitas::logUpdate(
                'harga_standar',
                'Harga standar bulk update: ' . $jenis->nama_jenis . ' (' . $request->persentase . '%)',
                ['harga_lama' => $oldHarga],
                ['harga_baru' => $newHarga]
            );

            $updated++;
        }

        return redirect()->route('admin.harga-standar.index')
            ->with('success', $updated . ' harga standar berhasil diupdate.');
    }

    /**
     * Compare harga bank dengan harga standar
     */
    public function compare()
    {
        $jenisSampah = JenisSampah::active()
            ->with(['hargaSampahBank.bankSampah'])
            ->orderBy('kategori')
            ->orderBy('nama_jenis')
            ->get();

        $comparison = [];

        foreach ($jenisSampah as $jenis) {
            $hargaBanks = $jenis->hargaSampahBank()
                ->with('bankSampah')
                ->latest('tanggal_berlaku')
                ->get()
                ->unique('bank_sampah_id');

            $comparison[] = [
                'jenis' => $jenis,
                'harga_standar' => $jenis->harga_standar,
                'harga_banks' => $hargaBanks,
            ];
        }

        return view('admin.harga-standar.compare', compact('comparison'));
    }

    /**
     * Export harga standar
     */
    public function export()
    {
        $jenisSampah = JenisSampah::active()
            ->orderBy('kategori')
            ->orderBy('nama_jenis')
            ->get();

        // Generate CSV
        $filename = 'harga-standar-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($jenisSampah) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, ['Kode', 'Nama Jenis', 'Kategori', 'Satuan', 'Harga Standar']);

            // Data
            foreach ($jenisSampah as $jenis) {
                fputcsv($file, [
                    $jenis->kode_jenis,
                    $jenis->nama_jenis,
                    ucfirst($jenis->kategori),
                    $jenis->satuan,
                    $jenis->harga_standar,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
