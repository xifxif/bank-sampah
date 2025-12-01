<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisSampah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jenis_sampah';

    protected $fillable = [
        'kode_jenis',
        'nama_jenis',
        'kategori',
        'satuan',
        'harga_standar',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'harga_standar' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Harga Sampah Bank
     */
    public function hargaSampahBank()
    {
        return $this->hasMany(HargaSampahBank::class, 'jenis_sampah_id');
    }

    /**
     * Relasi ke Transaksi Penyetoran
     */
    public function transaksiPenyetoran()
    {
        return $this->hasMany(TransaksiPenyetoran::class, 'jenis_sampah_id');
    }

    /**
     * Relasi ke Transaksi Penjualan
     */
    public function transaksiPenjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'jenis_sampah_id');
    }

    /**
     * Scope untuk jenis sampah aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Get total berat penyetoran untuk jenis sampah ini
     */
    public function getTotalBeratPenyetoranAttribute()
    {
        return $this->transaksiPenyetoran()->sum('berat');
    }

    /**
     * Get total nilai penyetoran untuk jenis sampah ini
     */
    public function getTotalNilaiPenyetoranAttribute()
    {
        return $this->transaksiPenyetoran()->sum('subtotal');
    }

    /**
     * Get total berat penjualan untuk jenis sampah ini
     */
    public function getTotalBeratPenjualanAttribute()
    {
        return $this->transaksiPenjualan()->sum('berat');
    }

    /**
     * Get total nilai penjualan untuk jenis sampah ini
     */
    public function getTotalNilaiPenjualanAttribute()
    {
        return $this->transaksiPenjualan()->sum('subtotal');
    }

    /**
     * Get formatted harga standar
     */
    public function getFormattedHargaStandarAttribute()
    {
        return 'Rp ' . number_format($this->harga_standar, 0, ',', '.');
    }

    /**
     * Get harga by bank sampah
     */
    public function getHargaByBank($bankSampahId)
    {
        $harga = $this->hargaSampahBank()
            ->where('bank_sampah_id', $bankSampahId)
            ->latest('tanggal_berlaku')
            ->first();

        return $harga ? $harga->harga : $this->harga_standar;
    }
}
