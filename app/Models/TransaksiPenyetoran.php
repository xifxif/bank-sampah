<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TransaksiPenyetoran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_penyetoran';

    protected $fillable = [
        'no_transaksi',
        'bank_sampah_id',
        'jenis_sampah_id',
        'user_id',
        'tanggal_setor',
        'nama_penyetor',
        'no_identitas',
        'berat',
        'harga_per_satuan',
        'subtotal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_setor' => 'date',
        'berat' => 'decimal:2',
        'harga_per_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Boot method untuk auto generate nomor transaksi
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->no_transaksi)) {
                $model->no_transaksi = self::generateNoTransaksi();
            }

            // Auto calculate subtotal
            $model->subtotal = $model->berat * $model->harga_per_satuan;
        });

        static::updating(function ($model) {
            // Auto calculate subtotal
            $model->subtotal = $model->berat * $model->harga_per_satuan;
        });
    }

    /**
     * Generate nomor transaksi otomatis
     */
    public static function generateNoTransaksi()
    {
        $prefix = 'PST';
        $date = date('Ymd');

        $lastTransaction = self::whereDate('created_at', today())
            ->latest('id')
            ->first();

        if ($lastTransaction) {
            $lastNumber = intval(substr($lastTransaction->no_transaksi, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . '-' . $date . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

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
     * Relasi ke User (Operator)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope untuk filter berdasarkan bank sampah
     */
    public function scopeByBank($query, $bankSampahId)
    {
        return $query->where('bank_sampah_id', $bankSampahId);
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeByDate($query, $startDate, $endDate = null)
    {
        if ($endDate) {
            return $query->whereBetween('tanggal_setor', [$startDate, $endDate]);
        }

        return $query->whereDate('tanggal_setor', $startDate);
    }

    /**
     * Scope untuk filter bulan ini
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('tanggal_setor', date('m'))
            ->whereYear('tanggal_setor', date('Y'));
    }

    /**
     * Scope untuk filter tahun ini
     */
    public function scopeThisYear($query)
    {
        return $query->whereYear('tanggal_setor', date('Y'));
    }

    /**
     * Get formatted subtotal
     */
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    /**
     * Get formatted harga per satuan
     */
    public function getFormattedHargaPerSatuanAttribute()
    {
        return 'Rp ' . number_format($this->harga_per_satuan, 0, ',', '.');
    }

    /**
     * Get formatted berat
     */
    public function getFormattedBeratAttribute()
    {
        return number_format($this->berat, 2, ',', '.') . ' ' . $this->jenisSampah->satuan;
    }
}
