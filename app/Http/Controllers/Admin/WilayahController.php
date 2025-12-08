<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data termasuk nonaktif + hitung jumlah bank sampah
        $query = Wilayah::withoutGlobalScopes()
            ->withCount('bankSampah');

        // Filter jenis wilayah
        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_wilayah', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_wilayah', 'like', '%' . $request->search . '%');
            });
        }

        // Urutkan & paginasi
        $wilayah = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.wilayah.index', compact('wilayah'));
    }

    public function create()
    {
        return view('admin.wilayah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_wilayah' => ['required', 'string', 'max:20', 'unique:wilayah'],
            'nama_wilayah' => ['required', 'string', 'max:100'],
            'jenis' => ['required', 'in:kecamatan,kelurahan,desa'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $wilayah = Wilayah::create($request->all());

        LogAktivitas::logCreate(
            'wilayah',
            'Wilayah baru dibuat: ' . $wilayah->nama_wilayah,
            $wilayah->toArray()
        );

        return redirect()->route('admin.wilayah.index')
            ->with('success', 'Wilayah berhasil ditambahkan.');
    }

    public function show(Wilayah $wilayah)
    {
        $wilayah->load(['bankSampah.transaksiPenyetoran', 'bankSampah.transaksiPenjualan']);

        return view('admin.wilayah.show', compact('wilayah'));
    }

    public function edit(Wilayah $wilayah)
    {
        return view('admin.wilayah.edit', [
            'itemWilayah' => $wilayah
        ]);
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $request->validate([
            'kode_wilayah' => ['required', 'string', 'max:20', Rule::unique('wilayah')->ignore($wilayah->id)],
            'nama_wilayah' => ['required', 'string', 'max:100'],
            'jenis' => ['required', 'in:kecamatan,kelurahan,desa'],
            'keterangan' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $oldData = $wilayah->toArray();

        $wilayah->update($request->all());

        LogAktivitas::logUpdate(
            'wilayah',
            'Wilayah diupdate: ' . $wilayah->nama_wilayah,
            $oldData,
            $wilayah->fresh()->toArray()
        );

        return redirect()->route('admin.wilayah.index')
            ->with('success', 'Wilayah berhasil diupdate.');
    }

    public function destroy(Wilayah $wilayah)
    {
        if ($wilayah->bankSampah()->count() > 0) {
            return redirect()->route('admin.wilayah.index')
                ->with('error', 'Wilayah tidak dapat dihapus karena masih memiliki Bank Sampah.');
        }

        $namaWilayah = $wilayah->nama_wilayah;
        $wilayahData = $wilayah->toArray();

        $wilayah->delete();

        LogAktivitas::logDelete(
            'wilayah',
            'Wilayah dihapus: ' . $namaWilayah,
            $wilayahData
        );

        return redirect()->route('admin.wilayah.index')
            ->with('success', 'Wilayah berhasil dihapus.');
    }
}
