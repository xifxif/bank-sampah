<?php

namespace App\Http\Controllers\BankSampah;

use App\Http\Controllers\Controller;
use App\Models\HargaSampahBank;
use App\Models\JenisSampah;
use App\Models\LogAktivitas;
use App\Models\TransaksiPenyetoran;
use Illuminate\Http\Request;

class PenyetoranController extends Controller
{
    public function index(Request $request)
    {
        $bankSampahId = auth()->user()->bank_sampah_id;
        
        $query = TransaksiPenyetoran::with(['jenisSampah', 'user'])
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
                  ->orWhere('nama_penyetor', 'like', '%' . $request->search . '%')
                  ->orWhere('no_identitas', 'like', '%' . $request->search . '%');
            });
        }

        $penyetoran = $query->latest('tanggal_setor')->paginate(20);
        $jenisSampah = JenisSampah::active()->orderBy('nama_jenis')->get();

        return view('bank-sampah.penyetoran.index', compact('penyetoran', 'jenisSampah'));
    }

    public function create()
    {
        $jenisSampah = JenisSampah::active()->orderBy('nama_jenis')->get();
        
        return view('bank-sampah.penyetoran.create', compact('jenisSampah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah_id' => ['required', 'exists:jenis_sampah,id'],
            'tanggal_setor' => ['required', 'date'],
            'nama_penyetor' => ['required', 'string', 'max:100'],
            'no_identitas' => ['nullable', 'string', 'max:50'],
            'berat' => ['required', 'numeric', 'min:0.01'],
            'harga_per_satuan' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $penyetoran = TransaksiPenyetoran::create([
            'bank_sampah_id' => auth()->user()->bank_sampah_id,
            'user_id' => auth()->id(),
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'tanggal_setor' => $request->tanggal_setor,
            'nama_penyetor' => $request->nama_penyetor,
            'no_identitas' => $request->no_identitas,
            'berat' => $request->berat,
            'harga_per_satuan' => $request->harga_per_satuan,
            'keterangan' => $request->keterangan,
        ]);

        LogAktivitas::logCreate(
            'transaksi_penyetoran',
            'Transaksi penyetoran baru: ' . $penyetoran->no_transaksi,
            $penyetoran->toArray()
        );

        return redirect()->route('bank-sampah.penyetoran.index')
            ->with('success', 'Transaksi penyetoran berhasil ditambahkan.');
    }

    public function show(TransaksiPenyetoran $penyetoran)
    {
        // Check authorization
        if ($penyetoran->bank_sampah_id !== auth()->user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $penyetoran->load(['jenisSampah', 'user', 'bankSampah']);

        return view('bank-sampah.penyetoran.show', compact('penyetoran'));
    }

    public function edit(TransaksiPenyetoran $penyetoran)
    {
        // Check authorization
        if ($penyetoran->bank_sampah_id !== auth()->user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $jenisSampah = JenisSampah::active()->orderBy('nama_jenis')->get();

        return view('bank-sampah.penyetoran.edit', compact('penyetoran', 'jenisSampah'));
    }

    public function update(Request $request, TransaksiPenyetoran $penyetoran)
    {
        // Check authorization
        if ($penyetoran->bank_sampah_id !== auth()->user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'jenis_sampah_id' => ['required', 'exists:jenis_sampah,id'],
            'tanggal_setor' => ['required', 'date'],
            'nama_penyetor' => ['required', 'string', 'max:100'],
            'no_identitas' => ['nullable', 'string', 'max:50'],
            'berat' => ['required', 'numeric', 'min:0.01'],
            'harga_per_satuan' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $oldData = $penyetoran->toArray();

        $penyetoran->update([
            'jenis_sampah_id' => $request->jenis_sampah_id,
            'tanggal_setor' => $request->tanggal_setor,
            'nama_penyetor' => $request->nama_penyetor,
            'no_identitas' => $request->no_identitas,
            'berat' => $request->berat,
            'harga_per_satuan' => $request->harga_per_satuan,
            'keterangan' => $request->keterangan,
        ]);

        LogAktivitas::logUpdate(
            'transaksi_penyetoran',
            'Transaksi penyetoran diupdate: ' . $penyetoran->no_transaksi,
            $oldData,
            $penyetoran->fresh()->toArray()
        );

        return redirect()->route('bank-sampah.penyetoran.index')
            ->with('success', 'Transaksi penyetoran berhasil diupdate.');
    }

    public function destroy(TransaksiPenyetoran $penyetoran)
    {
        // Check authorization
        if ($penyetoran->bank_sampah_id !== auth()->user()->bank_sampah_id) {
            abort(403, 'Unauthorized action.');
        }

        $noTransaksi = $penyetoran->no_transaksi;
        $penyetoranData = $penyetoran->toArray();

        $penyetoran->delete();

        LogAktivitas::logDelete(
            'transaksi_penyetoran',
            'Transaksi penyetoran dihapus: ' . $noTransaksi,
            $penyetoranData
        );

        return redirect()->route('bank-sampah.penyetoran.index')
            ->with('success', 'Transaksi penyetoran berhasil dihapus.');
    }

    /**
     * Get harga jenis sampah untuk AJAX
     */
    public function getHarga($jenisSampahId)
    {
        $bankSampahId = auth()->user()->bank_sampah_id;
        $jenisSampah = JenisSampah::findOrFail($jenisSampahId);
        
        // Cari harga yang sudah ditetapkan bank
        $hargaBank = HargaSampahBank::where('bank_sampah_id', $bankSampahId)
            ->where('jenis_sampah_id', $jenisSampahId)
            ->latest('tanggal_berlaku')
            ->first();
        
        // Gunakan harga bank jika ada, jika tidak gunakan harga standar
        $harga = $hargaBank ? $hargaBank->harga : $jenisSampah->harga_standar;
        
        return response()->json([
            'harga' => $harga,
            'satuan' => $jenisSampah->satuan,
            'harga_bank' => $hargaBank ? $hargaBank->harga : null,
            'harga_standar' => $jenisSampah->harga_standar,
            'source' => $hargaBank ? 'bank' : 'standar',
        ]);
    }
}