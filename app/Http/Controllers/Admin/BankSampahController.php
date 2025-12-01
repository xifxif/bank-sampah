<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\LogAktivitas;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BankSampahController extends Controller
{
    public function index(Request $request)
    {
        $query = BankSampah::with('wilayah');

        if ($request->filled('wilayah_id')) {
            $query->byWilayah($request->wilayah_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_bank', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_bank', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_pengelola', 'like', '%' . $request->search . '%');
            });
        }

        $bankSampah = $query->latest()->paginate(20);
        $wilayah = Wilayah::active()->orderBy('nama_wilayah')->get();

        return view('admin.bank-sampah.index', compact('bankSampah', 'wilayah'));
    }

    public function create()
    {
        $wilayah = Wilayah::active()->orderBy('nama_wilayah')->get();

        return view('admin.bank-sampah.create', compact('wilayah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wilayah_id' => ['required', 'exists:wilayah,id'],
            'kode_bank' => ['required', 'string', 'max:20', 'unique:bank_sampah'],
            'nama_bank' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'nama_pengelola' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:100'],
            'tanggal_berdiri' => ['nullable', 'date'],
            'status' => ['required', 'in:aktif,nonaktif,pending'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $bankSampah = BankSampah::create($request->all());

        LogAktivitas::logCreate(
            'bank_sampah',
            'Bank Sampah baru dibuat: ' . $bankSampah->nama_bank,
            $bankSampah->toArray()
        );

        return redirect()->route('admin.bank-sampah.index')
            ->with('success', 'Bank Sampah berhasil ditambahkan.');
    }

    public function show(BankSampah $bankSampah)
    {
        $bankSampah->load([
            'wilayah',
            'users',
            'transaksiPenyetoran.jenisSampah',
            'transaksiPenjualan.jenisSampah',
            'hargaSampah.jenisSampah'
        ]);

        // Statistics
        $stats = [
            'total_penyetoran' => $bankSampah->transaksiPenyetoran->count(),
            'total_penjualan' => $bankSampah->transaksiPenjualan->count(),
            'total_berat_penyetoran' => $bankSampah->transaksiPenyetoran->sum('berat'),
            'total_nilai_penyetoran' => $bankSampah->transaksiPenyetoran->sum('subtotal'),
            'total_berat_penjualan' => $bankSampah->transaksiPenjualan->sum('berat'),
            'total_nilai_penjualan' => $bankSampah->transaksiPenjualan->sum('subtotal'),
        ];

        return view('admin.bank-sampah.show', compact('bankSampah', 'stats'));
    }

    public function edit(BankSampah $bankSampah)
    {
        $wilayah = Wilayah::active()->orderBy('nama_wilayah')->get();

        return view('admin.bank-sampah.edit', compact('bankSampah', 'wilayah'));
    }

    public function update(Request $request, BankSampah $bankSampah)
    {
        $request->validate([
            'wilayah_id' => ['required', 'exists:wilayah,id'],
            'kode_bank' => ['required', 'string', 'max:20', Rule::unique('bank_sampah')->ignore($bankSampah->id)],
            'nama_bank' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'nama_pengelola' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:100'],
            'tanggal_berdiri' => ['nullable', 'date'],
            'status' => ['required', 'in:aktif,nonaktif,pending'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $oldData = $bankSampah->toArray();

        $bankSampah->update($request->all());

        LogAktivitas::logUpdate(
            'bank_sampah',
            'Bank Sampah diupdate: ' . $bankSampah->nama_bank,
            $oldData,
            $bankSampah->fresh()->toArray()
        );

        return redirect()->route('admin.bank-sampah.index')
            ->with('success', 'Bank Sampah berhasil diupdate.');
    }

    public function destroy(BankSampah $bankSampah)
    {
        // Check if bank sampah has transactions
        if ($bankSampah->transaksiPenyetoran()->count() > 0 || $bankSampah->transaksiPenjualan()->count() > 0) {
            return redirect()->route('admin.bank-sampah.index')
                ->with('error', 'Bank Sampah tidak dapat dihapus karena masih memiliki transaksi.');
        }

        $namaBankSampah = $bankSampah->nama_bank;
        $bankSampahData = $bankSampah->toArray();

        $bankSampah->delete();

        LogAktivitas::logDelete(
            'bank_sampah',
            'Bank Sampah dihapus: ' . $namaBankSampah,
            $bankSampahData
        );

        return redirect()->route('admin.bank-sampah.index')
            ->with('success', 'Bank Sampah berhasil dihapus.');
    }
}
