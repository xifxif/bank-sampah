<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\BankSampah;

class EnsureBankSampahId
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        // Jika user role bank_sampah tapi belum punya bank_sampah_id
        if ($user && $user->hasRole('bank_sampah') && !$user->bank_sampah_id) {
            // Cari bank_sampah yang sesuai atau ambil yang pertama
            $bankSampah = BankSampah::first();
            
            if ($bankSampah) {
                $user->bank_sampah_id = $bankSampah->id;
                $user->save();
            }
        }
        
        return $next($request);
    }
}