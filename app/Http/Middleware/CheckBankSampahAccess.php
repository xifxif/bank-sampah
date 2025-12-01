<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBankSampahAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user has bank_sampah role
        if (!$user->hasRole('bank_sampah')) {
            abort(403, 'Unauthorized. Bank Sampah access only.');
        }

        // Check if user has bank_sampah_id
        if (!$user->bank_sampah_id) {
            abort(403, 'Unauthorized. No Bank Sampah assigned.');
        }

        return $next($request);
    }
}
