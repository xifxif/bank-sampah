<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JenisSampahController extends Controller
{
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

        $jenisSampah = $query->latest()->paginate(20);

        return view('admin.jenis-sampah.index', compact('jenisSampah'));
    }

    public function create()
    {
        return view('admin.jenis-sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jenis' => ['required', 'string', 'max:20', 'unique:jenis_sampah'],
            'nama_jenis' => ['required', 'string', 'max:100'],
            'kategori' => ['required', 'in:organik,anorganik,b3'],
            'satuan' => ['required', 'string', 'max:20'],
            'harga_standar' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $jenisSampah = JenisSampah::create($request->all());

        LogAktivitas::logCreate(
            'jenis_sampah',
            'Jenis Sampah baru dibuat: ' . $jenisSampah->nama_jenis,
            $jenisSampah->toArray()
        );

        return redirect()->route('admin.jenis-sampah.index')
            ->with('success', 'Jenis Sampah berhasil ditambahkan.');
    }

    public function show(JenisSampah $jenisSampah)
    {
        $jenisSampah->load([
            'transaksiPenyetoran.bankSampah',
            'transaksiPenjualan.bankSampah',
            'hargaSampahBank.bankSampah'
        ]);

        // Statistics
        $stats = [
            'total_penyetoran' => $jenisSampah->transaksiPenyetoran->count(),
            'total_penjualan' => $jenisSampah->transaksiPenjualan->count(),
            'total_berat_penyetoran' => $jenisSampah->transaksiPenyetoran->sum('berat'),
            'total_nilai_penyetoran' => $jenisSampah->transaksiPenyetoran->sum('subtotal'),
            'total_berat_penjualan' => $jenisSampah->transaksiPenjualan->sum('berat'),
            'total_nilai_penjualan' => $jenisSampah->transaksiPenjualan->sum('subtotal'),
        ];

        return view('admin.jenis-sampah.show', compact('jenisSampah', 'stats'));
    }

    public function edit(JenisSampah $jenisSampah)
    {
        return view('admin.jenis-sampah.edit', compact('jenisSampah'));
    }

    public function update(Request $request, JenisSampah $jenisSampah)
    {
        $request->validate([
            'kode_jenis' => ['required', 'string', 'max:20', Rule::unique('jenis_sampah')->ignore($jenisSampah->id)],
            'nama_jenis' => ['required', 'string', 'max:100'],
            'kategori' => ['required', 'in:organik,anorganik,b3'],
            'satuan' => ['required', 'string', 'max:20'],
            'harga_standar' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $oldData = $jenisSampah->toArray();

        $jenisSampah->update($request->all());

        LogAktivitas::logUpdate(
            'jenis_sampah',
            'Jenis Sampah diupdate: ' . $jenisSampah->nama_jenis,
            $oldData,
            $jenisSampah->fresh()->toArray()
        );

        return redirect()->route('admin.jenis-sampah.index')
            ->with('success', 'Jenis Sampah berhasil diupdate.');
    }

    public function destroy(JenisSampah $jenisSampah)
    {
        // Check if jenis sampah has transactions
        if ($jenisSampah->transaksiPenyetoran()->count() > 0 || $jenisSampah->transaksiPenjualan()->count() > 0) {
            return redirect()->route('admin.jenis-sampah.index')
                ->with('error', 'Jenis Sampah tidak dapat dihapus karena masih memiliki transaksi.');
        }

        $namaJenisSampah = $jenisSampah->nama_jenis;
        $jenisSampahData = $jenisSampah->toArray();

        $jenisSampah->delete();

        LogAktivitas::logDelete(
            'jenis_sampah',
            'Jenis Sampah dihapus: ' . $namaJenisSampah,
            $jenisSampahData
        );

        return redirect()->route('admin.jenis-sampah.index')
            ->with('success', 'Jenis Sampah berhasil dihapus.');
    }
}
