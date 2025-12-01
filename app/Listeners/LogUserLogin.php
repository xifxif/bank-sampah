<?php

namespace App\Listeners;

use App\Models\LogAktivitas;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        LogAktivitas::create([
            'user_id' => $event->user->id,
            'bank_sampah_id' => $event->user->bank_sampah_id,
            'aktivitas' => 'login',
            'modul' => 'auth',
            'deskripsi' => $event->user->name . ' berhasil login ke sistem',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
