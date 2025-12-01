<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bank_sampah_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke Bank Sampah
     */
    public function bankSampah()
    {
        return $this->belongsTo(BankSampah::class, 'bank_sampah_id');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is bank sampah operator
     */
    public function isBankSampah(): bool
    {
        return $this->hasRole('bank_sampah');
    }

    /**
     * Relasi ke transaksi penyetoran yang dibuat user ini
     */
    public function transaksiPenyetoran()
    {
        return $this->hasMany(TransaksiPenyetoran::class, 'user_id');
    }

    /**
     * Relasi ke transaksi penjualan yang dibuat user ini
     */
    public function transaksiPenjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'user_id');
    }

    /**
     * Relasi ke log aktivitas user
     */
    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'user_id');
    }

    /**
     * Scope untuk admin only
     */
    public function scopeAdmins($query)
    {
        return $query->role('admin');
    }

    /**
     * Scope untuk bank sampah operators only
     */
    public function scopeBankSampahOperators($query)
    {
        return $query->role('bank_sampah');
    }

    /**
     * Scope untuk filter berdasarkan bank sampah
     */
    public function scopeByBank($query, $bankSampahId)
    {
        return $query->where('bank_sampah_id', $bankSampahId);
    }

    /**
     * Get total transaksi by user
     */
    public function getTotalTransaksiAttribute()
    {
        return $this->transaksiPenyetoran()->count() +
            $this->transaksiPenjualan()->count();
    }
}
