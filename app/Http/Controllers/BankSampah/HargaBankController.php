<?php

namespace App\Http\Controllers\BankSampah;

use App\Http\Controllers\Controller;
use App\Models\HargaSampahBank;
use App\Models\JenisSampah;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class HargaBankController extends Controller
{
    public function index()
    {
        $bankSampahId = auth()->user()->bank_sampah_id;

        $jenisSampah = JenisSampah::active()
            ->with(['hargaSampahBank' => function ($query) use ($bankSampahId) {
                $query->where('bank_sampah_id', $bankSampahId)
                    ->latest('tanggal_berlaku')
                    ->limit(1);
            }])
            ->orderBy('kategori')
            ->orderBy('nama_jenis')
            ->get();

        return view('bank-sampah.harga.index', compact('jenisSampah'));
    }

    public function create()
    {
        $bankSampahId = auth()->user()->bank_sampah_id;

        // Get jenis sampah yang belum punya harga atau harga yang sudah ada
        $jenisSampah = JenisSampah::active()
            ->with(['hargaSampahBank' => function ($query) use ($bankSampahId) {
                $query->where('bank_sampah_id', $bankSampahId)
                    ->latest('tanggal_berlaku');
            }])
            ->orderBy('kategori')
            ->orderBy('nama_jenis')
            ->get();

        return view('bank-sampah.harga.create', compact('jenisSampah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah_id' => ['required', 'exists:jenis_sampah,id'],
            'harga' => ['required', 'numeric', 'min:0'],
            'tanggal_berlaku' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $harga = HargaSampahBank::create([
            'bank_sampah_id' => auth()->user()->bank_sampah_id,
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'harga' => $request->harga,
            'tanggal_berlaku' => $request->tanggal_berlaku,
            'keterangan' => $request->keterangan,
        ]);

        LogAktivitas::logCreate(
            'harga_sampah_bank',
            'Harga sampah baru ditambahkan',
            $harga->toArray()
        );

        return redirect()->route('bank-sampah.harga.index')
            ->with('success', 'Harga sampah berhasil ditambahkan.');
    }

    public function edit(HargaSampahBank $harga)
    {
        // Check authorization
        if ($harga->bank_sampah_id !== auth()->user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $jenisSampah = JenisSampah::active()->orderBy('nama_jenis')->get();

        return view('bank-sampah.harga.edit', compact('harga', 'jenisSampah'));
    }

    public function update(Request $request, HargaSampahBank $harga)
    {
        // Check authorization
        if ($harga->bank_sampah_id !== auth()->user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'jenis_sampah_id' => ['required', 'exists:jenis_sampah,id'],
            'harga' => ['required', 'numeric', 'min:0'],
            'tanggal_berlaku' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $oldData = $harga->toArray();

        $harga->update([
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'harga' => $request->harga,
            'tanggal_berlaku' => $request->tanggal_berlaku,
            'keterangan' => $request->keterangan,
        ]);

        LogAktivitas::logUpdate(
            'harga_sampah_bank',
            'Harga sampah diupdate',
            $oldData,
            $harga->fresh()->toArray()
        );

        return redirect()->route('bank-sampah.harga.index')
            ->with('success', 'Harga sampah berhasil diupdate.');
    }

    public function destroy(HargaSampahBank $harga)
    {
        // Check authorization
        if ($harga->bank_sampah_id !== auth()->user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $hargaData = $harga->toArray();

        $harga->delete();

        LogAktivitas::logDelete(
            'harga_sampah_bank',
            'Harga sampah dihapus',
            $hargaData
        );

        return redirect()->route('bank-sampah.harga.index')
            ->with('success', 'Harga sampah berhasil dihapus.');
    }
}
