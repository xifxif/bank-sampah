<?php

namespace App\Listeners;

use App\Models\LogAktivitas;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogout
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
    public function handle(Logout $event): void
    {
        if ($event->user) {
            LogAktivitas::create([
                'user_id' => $event->user->id,
                'bank_sampah_id' => $event->user->bank_sampah_id,
                'aktivitas' => 'logout',
                'modul' => 'auth',
                'deskripsi' => $event->user->name . ' keluar dari sistem',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
    }
}
