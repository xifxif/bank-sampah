<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankSampah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bank_sampah';

    protected $fillable = [
        'wilayah_id',
        'kode_bank',
        'nama_bank',
        'alamat',
        'no_telepon',
        'nama_pengelola',
        'email',
        'tanggal_berdiri',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_berdiri' => 'date',
    ];

    /**
     * Relasi ke Wilayah
     */
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    /**
     * Relasi ke Users (Operator)
     */
    public function users()
    {
        return $this->hasMany(User::class, 'bank_sampah_id');
    }

    /**
     * Relasi ke Harga Sampah Bank
     */
    public function hargaSampah()
    {
        return $this->hasMany(HargaSampahBank::class, 'bank_sampah_id');
    }

    /**
     * Relasi ke Transaksi Penyetoran
     */
    public function transaksiPenyetoran()
    {
        return $this->hasMany(TransaksiPenyetoran::class, 'bank_sampah_id');
    }

    /**
     * Relasi ke Transaksi Penjualan
     */
    public function transaksiPenjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'bank_sampah_id');
    }

    /**
     * Relasi ke Log Aktivitas
     */
    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'bank_sampah_id');
    }

    /**
     * Scope untuk bank sampah aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk bank sampah non-aktif
     */
    public function scopeNonActive($query)
    {
        return $query->where('status', 'nonaktif');
    }

    /**
     * Scope untuk filter berdasarkan wilayah
     */
    public function scopeByWilayah($query, $wilayahId)
    {
        return $query->where('wilayah_id', $wilayahId);
    }

    /**
     * Get total penyetoran (berat)
     */
    public function getTotalBeratPenyetoranAttribute()
    {
        return $this->transaksiPenyetoran()->sum('berat');
    }

    /**
     * Get total nilai penyetoran
     */
    public function getTotalNilaiPenyetoranAttribute()
    {
        return $this->transaksiPenyetoran()->sum('subtotal');
    }

    /**
     * Get total penjualan (berat)
     */
    public function getTotalBeratPenjualanAttribute()
    {
        return $this->transaksiPenjualan()->sum('berat');
    }

    /**
     * Get total nilai penjualan
     */
    public function getTotalNilaiPenjualanAttribute()
    {
        return $this->transaksiPenjualan()->sum('subtotal');
    }

    /**
     * Get total transaksi
     */
    public function getTotalTransaksiAttribute()
    {
        return $this->transaksiPenyetoran()->count() + $this->transaksiPenjualan()->count();
    }

    /**
     * Check if bank sampah is active
     */
    public function isActive()
    {
        return $this->status === 'aktif';
    }

    /**
     * Get harga untuk jenis sampah tertentu
     */
    public function getHargaJenisSampah($jenisSampahId)
    {
        $harga = $this->hargaSampah()
            ->where('jenis_sampah_id', $jenisSampahId)
            ->latest('tanggal_berlaku')
            ->first();

        return $harga ? $harga->harga : 0;
    }
}
