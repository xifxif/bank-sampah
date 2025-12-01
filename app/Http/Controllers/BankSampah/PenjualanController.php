<?php

namespace App\Http\Controllers\BankSampah;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\LogAktivitas;
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $bankSampahId = Auth::user()->bank_sampah_id;

        $query = TransaksiPenjualan::with(['jenisSampah', 'user'])
            ->byBank($bankSampahId);

        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->byDate($request->tanggal_dari, $request->tanggal_sampai);
        }

        if ($request->filled('jenis_sampah_id')) {
            $query->where('jenis_sampah_id', $request->jenis_sampah_id);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('no_transaksi', 'like', '%' . $request->search . '%')
                    ->orWhere('pembeli', 'like', '%' . $request->search . '%')
                    ->orWhere('no_telepon_pembeli', 'like', '%' . $request->search . '%');
            });
        }

        $penjualan = $query->latest('tanggal_jual')->paginate(20);
        $jenisSampah = JenisSampah::active()->orderBy('nama_jenis')->get();

        return view('bank-sampah.penjualan.index', compact('penjualan', 'jenisSampah'));
    }

    public function create()
    {
        $jenisSampah = JenisSampah::active()->orderBy('nama_jenis')->get();

        return view('bank-sampah.penjualan.create', compact('jenisSampah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah_id' => ['required', 'exists:jenis_sampah,id'],
            'tanggal_jual' => ['required', 'date'],
            'pembeli' => ['required', 'string', 'max:100'],
            'no_telepon_pembeli' => ['nullable', 'string', 'max:20'],
            'berat' => ['required', 'numeric', 'min:0.01'],
            'harga_jual_per_satuan' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $penjualan = TransaksiPenjualan::create([
            'bank_sampah_id' => Auth::user()->bank_sampah_id,
            'user_id' => Auth::id(),
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'tanggal_jual' => $request->tanggal_jual,
            'pembeli' => $request->pembeli,
            'no_telepon_pembeli' => $request->no_telepon_pembeli,
            'berat' => $request->berat,
            'harga_jual_per_satuan' => $request->harga_jual_per_satuan,
            'keterangan' => $request->keterangan,
        ]);

        LogAktivitas::logCreate(
            'transaksi_penjualan',
            'Transaksi penjualan baru: ' . $penjualan->no_transaksi,
            $penjualan->toArray()
        );

        return redirect()->route('bank-sampah.penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil ditambahkan.');
    }

    public function show(TransaksiPenjualan $penjualan)
    {
        // Check authorization
        if ($penjualan->bank_sampah_id !== Auth::user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $penjualan->load(['jenisSampah', 'user', 'bankSampah']);

        return view('bank-sampah.penjualan.show', compact('penjualan'));
    }

    public function edit(TransaksiPenjualan $penjualan)
    {
        // Check authorization
        if ($penjualan->bank_sampah_id !== Auth::user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $jenisSampah = JenisSampah::active()->orderBy('nama_jenis')->get();

        return view('bank-sampah.penjualan.edit', compact('penjualan', 'jenisSampah'));
    }

    public function update(Request $request, TransaksiPenjualan $penjualan)
    {
        // Check authorization
        if ($penjualan->bank_sampah_id !== Auth::user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'jenis_sampah_id' => ['required', 'exists:jenis_sampah,id'],
            'tanggal_jual' => ['required', 'date'],
            'pembeli' => ['required', 'string', 'max:100'],
            'no_telepon_pembeli' => ['nullable', 'string', 'max:20'],
            'berat' => ['required', 'numeric', 'min:0.01'],
            'harga_jual_per_satuan' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $oldData = $penjualan->toArray();

        $penjualan->update([
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'tanggal_jual' => $request->tanggal_jual,
            'pembeli' => $request->pembeli,
            'no_telepon_pembeli' => $request->no_telepon_pembeli,
            'berat' => $request->berat,
            'harga_jual_per_satuan' => $request->harga_jual_per_satuan,
            'keterangan' => $request->keterangan,
        ]);

        LogAktivitas::logUpdate(
            'transaksi_penjualan',
            'Transaksi penjualan diupdate: ' . $penjualan->no_transaksi,
            $oldData,
            $penjualan->fresh()->toArray()
        );

        return redirect()->route('bank-sampah.penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil diupdate.');
    }

    public function destroy(TransaksiPenjualan $penjualan)
    {
        // Check authorization
        if ($penjualan->bank_sampah_id !== Auth::user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $noTransaksi = $penjualan->no_transaksi;
        $penjualanData = $penjualan->toArray();

        $penjualan->delete();

        LogAktivitas::logDelete(
            'transaksi_penjualan',
            'Transaksi penjualan dihapus: ' . $noTransaksi,
            $penjualanData
        );

        return redirect()->route('bank-sampah.penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil dihapus.');
    }
}
