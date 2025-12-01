<?php

namespace App\Http\Middleware;

use App\Models\LogAktivitas;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only log for authenticated users
        if (Auth::check()) {
            // Log setiap aktivitas (optional, bisa dimatikan jika terlalu banyak)
            // Uncomment jika ingin log setiap request
            /*
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'bank_sampah_id' => Auth::user()->bank_sampah_id,
                'aktivitas' => 'access',
                'modul' => $request->route() ? $request->route()->getName() : 'unknown',
                'deskripsi' => Auth::user()->name . ' mengakses ' . $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            */
        }

        return $response;
    }
}
