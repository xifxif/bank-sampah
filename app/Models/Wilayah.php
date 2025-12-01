<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wilayah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wilayah';

    protected $fillable = [
        'kode_wilayah',
        'nama_wilayah',
        'jenis',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Bank Sampah
     */
    public function bankSampah()
    {
        return $this->hasMany(BankSampah::class, 'wilayah_id');
    }

    /**
     * Get active bank sampah in this wilayah
     */
    public function bankSampahAktif()
    {
        return $this->hasMany(BankSampah::class, 'wilayah_id')
            ->where('status', 'aktif');
    }

    /**
     * Scope untuk wilayah aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk filter berdasarkan jenis
     */
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    /**
     * Get total bank sampah in this wilayah
     */
    public function getTotalBankSampahAttribute()
    {
        return $this->bankSampah()->count();
    }

    /**
     * Get total active bank sampah
     */
    public function getTotalBankSampahAktifAttribute()
    {
        return $this->bankSampahAktif()->count();
    }
}
