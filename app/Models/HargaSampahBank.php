<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaSampahBank extends Model
{
    use HasFactory;

    protected $table = 'harga_sampah_bank';

    protected $fillable = [
        'bank_sampah_id',
        'jenis_sampah_id',
        'harga',
        'tanggal_berlaku',
        'keterangan',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'tanggal_berlaku' => 'date',
    ];

    /**
     * Relasi ke Bank Sampah
     */
    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class, 'bank_sampah_id');
    }

    /**
     * Relasi ke Jenis Sampah
     */
    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class, 'jenis_sampah_id');
    }

    /**
     * Scope untuk harga aktif (terbaru)
     */
    public function scopeAktif($query)
    {
        return $query->latest('tanggal_berlaku');
    }

    /**
     * Scope untuk filter berdasarkan bank sampah
     */
    public function scopeByBank($query, $bankSampahId)
    {
        return $query->where('bank_sampah_id', $bankSampahId);
    }

    /**
     * Scope untuk filter berdasarkan jenis sampah
     */
    public function scopeByJenis($query, $jenisSampahId)
    {
        return $query->where('jenis_sampah_id', $jenisSampahId);
    }

    /**
     * Get formatted harga
     */
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Get selisih dengan harga standar
     */
    public function getSelisihHargaStandarAttribute()
    {
        $hargaStandar = $this->jenisSampah->harga_standar;
        return $this->harga - $hargaStandar;
    }

    /**
     * Get persentase selisih dengan harga standar
     */
    public function getPersentaseSelisihAttribute()
    {
        $hargaStandar = $this->jenisSampah->harga_standar;

        if ($hargaStandar == 0) {
            return 0;
        }

        return (($this->harga - $hargaStandar) / $hargaStandar) * 100;
    }

    /**
     * Check if harga lebih rendah dari standar
     */
    public function isLebihRendah()
    {
        return $this->harga < $this->jenisSampah->harga_standar;
    }

    /**
     * Check if harga lebih tinggi dari standar
     */
    public function isLebihTinggi()
    {
        return $this->harga > $this->jenisSampah->harga_standar;
    }
}
