<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display welcome page with price list
     */
    public function index()
    {
        // Ambil semua jenis sampah yang aktif, diurutkan berdasarkan kategori dan nama
        $jenisSampah = JenisSampah::active()
            ->orderBy('kategori')
            ->orderBy('nama')
            ->get();

        return view('welcome', compact('jenisSampah'));
    }
}
