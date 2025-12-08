<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiPenjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_penjualan';

    protected $fillable = [
        'no_transaksi',
        'bank_sampah_id',
        'jenis_sampah_id',
        'user_id',
        'tanggal_jual',
        'pembeli',
        'no_telepon_pembeli',
        'berat',
        'harga_jual_per_satuan',
        'subtotal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_jual' => 'date',
        'berat' => 'decimal:2',
        'harga_jual_per_satuan' => 'decimal:2',
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
            $model->subtotal = $model->berat * $model->harga_jual_per_satuan;
        });

        static::updating(function ($model) {
            // Auto calculate subtotal
            $model->subtotal = $model->berat * $model->harga_jual_per_satuan;
        });
    }

    /**
     * Generate nomor transaksi otomatis
     */
    public static function generateNoTransaksi()
    {
        $prefix = 'PJL';
        $date = date('Ymd');

        // Pakai withTrashed() karena soft delete, dan tambah lockForUpdate()
        $lastTransaction = self::withTrashed()
            ->whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->lockForUpdate()
            ->first();

        if ($lastTransaction) {
            // Ambil 4 digit terakhir dari nomor transaksi
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
            return $query->whereBetween('tanggal_jual', [$startDate, $endDate]);
        }

        return $query->whereDate('tanggal_jual', $startDate);
    }

    /**
     * Scope untuk filter bulan ini
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('tanggal_jual', date('m'))
            ->whereYear('tanggal_jual', date('Y'));
    }

    /**
     * Scope untuk filter tahun ini
     */
    public function scopeThisYear($query)
    {
        return $query->whereYear('tanggal_jual', date('Y'));
    }

    /**
     * Get formatted subtotal
     */
    public function getFormattedSubtotalAttribute()
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    /**
     * Get formatted harga jual per satuan
     */
    public function getFormattedHargaJualPerSatuanAttribute()
    {
        return 'Rp ' . number_format($this->harga_jual_per_satuan, 0, ',', '.');
    }

    /**
     * Get formatted berat
     */
    public function getFormattedBeratAttribute()
    {
        return number_format($this->berat, 2, ',', '.') . ' ' . $this->jenisSampah->satuan;
    }

    /**
     * Calculate profit/margin
     */
    public function getProfitAttribute()
    {
        $hargaSetor = $this->bankSampah->getHargaJenisSampah($this->jenis_sampah_id);
        return ($this->harga_jual_per_satuan - $hargaSetor) * $this->berat;
    }

    /**
     * Get formatted profit
     */
    public function getFormattedProfitAttribute()
    {
        return 'Rp ' . number_format($this->profit, 0, ',', '.');
    }
}