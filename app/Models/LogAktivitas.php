<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'bank_sampah_id',
        'aktivitas',
        'modul',
        'deskripsi',
        'ip_address',
        'user_agent',
        'data_lama',
        'data_baru',
    ];

    protected $casts = [
        'data_lama' => 'array',
        'data_baru' => 'array',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Bank Sampah
     */
    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class, 'bank_sampah_id');
    }

    /**
     * Scope untuk filter berdasarkan user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk filter berdasarkan bank sampah
     */
    public function scopeByBank($query, $bankSampahId)
    {
        return $query->where('bank_sampah_id', $bankSampahId);
    }

    /**
     * Scope untuk filter berdasarkan modul
     */
    public function scopeByModul($query, $modul)
    {
        return $query->where('modul', $modul);
    }

    /**
     * Scope untuk filter berdasarkan aktivitas
     */
    public function scopeByAktivitas($query, $aktivitas)
    {
        return $query->where('aktivitas', $aktivitas);
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeByDate($query, $startDate, $endDate = null)
    {
        if ($endDate) {
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->whereDate('created_at', $startDate);
    }

    /**
     * Scope untuk hari ini
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope untuk minggu ini
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    /**
     * Scope untuk bulan ini
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'));
    }

    /**
     * Get user name or 'System'
     */
    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : 'System';
    }

    /**
     * Get bank name or '-'
     */
    public function getBankNameAttribute()
    {
        return $this->bankSampah ? $this->bankSampah->nama_bank : '-';
    }

    /**
     * Static method untuk create log
     */
    public static function createLog($aktivitas, $modul, $deskripsi, $dataLama = null, $dataBaru = null, $userId = null, $bankSampahId = null)
    {
        // Get current request instance if available
        $request = app('request');

        return self::create([
            'user_id' => $userId ?? (Auth::check() ? Auth::id() : null),
            'bank_sampah_id' => $bankSampahId ?? (Auth::check() ? Auth::user()->bank_sampah_id ?? null : null),
            'aktivitas' => $aktivitas,
            'modul' => $modul,
            'deskripsi' => $deskripsi,
            'ip_address' => $request ? $request->ip() : null,
            'user_agent' => $request ? $request->userAgent() : null,
            'data_lama' => $dataLama,
            'data_baru' => $dataBaru,
        ]);
    }

    /**
     * Static method untuk log login
     */
    public static function logLogin($userId = null, $userName = null)
    {
        $user = Auth::user();
        $name = $userName ?? ($user ? $user->name : 'Unknown User');

        return self::createLog(
            'login',
            'auth',
            $name . ' melakukan login ke sistem',
            null,
            null,
            $userId ?? ($user ? $user->id : null)
        );
    }

    /**
     * Static method untuk log logout
     */
    public static function logLogout($userId = null, $userName = null)
    {
        $user = Auth::user();
        $name = $userName ?? ($user ? $user->name : 'Unknown User');

        return self::createLog(
            'logout',
            'auth',
            $name . ' melakukan logout dari sistem',
            null,
            null,
            $userId ?? ($user ? $user->id : null)
        );
    }

    /**
     * Static method untuk log create
     */
    public static function logCreate($modul, $deskripsi, $data, $userId = null, $bankSampahId = null)
    {
        return self::createLog('create', $modul, $deskripsi, null, $data, $userId, $bankSampahId);
    }

    /**
     * Static method untuk log update
     */
    public static function logUpdate($modul, $deskripsi, $dataLama, $dataBaru, $userId = null, $bankSampahId = null)
    {
        return self::createLog('update', $modul, $deskripsi, $dataLama, $dataBaru, $userId, $bankSampahId);
    }

    /**
     * Static method untuk log delete
     */
    public static function logDelete($modul, $deskripsi, $data, $userId = null, $bankSampahId = null)
    {
        return self::createLog('delete', $modul, $deskripsi, $data, null, $userId, $bankSampahId);
    }
}
