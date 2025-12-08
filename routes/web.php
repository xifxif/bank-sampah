<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Admin\BankSampahController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\JenisSampahController;
use App\Http\Controllers\Admin\HargaStandarController;
use App\Http\Controllers\BankSampah\HargaBankController;
use App\Http\Controllers\BankSampah\PenjualanController;
use App\Http\Controllers\BankSampah\PenyetoranController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\BankSampah\LaporanController as BankSampahLaporanController;
use App\Http\Controllers\BankSampah\DashboardController as BankSampahDashboardController;

use App\Models\User;

Route::get('/fix-admin-pengelola', function () {
    $user = User::where('email', 'pedulilingkungan@gmail.com')->first();
    
    if ($user) {
        $user->bank_sampah_id = 1;
        $user->save();
        return 'User bank_sampah_id berhasil diupdate! Sekarang hapus route ini.';
    }
    
    return 'User tidak ditemukan';
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::view('/artikel/memilah-sampah', 'artikel-memilah-sampah')->name('artikel.memilah');
Route::view('/artikel/teknologi-plastik', 'artikel-teknologi')->name('artikel.teknologi');

/*
|--------------------------------------------------------------------------
| Redirect After Login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->get('/dashboard', function () {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->hasRole('bank_sampah')) {
            return redirect()->route('bank-sampah.dashboard');
        }

        // Jika tidak punya role, redirect ke home dengan pesan error
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke sistem.');
    })->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // User Management
        Route::resource('users', UserController::class);

        // Master Data - Wilayah
        Route::resource('wilayah', WilayahController::class);

        // Master Data - Bank Sampah
        Route::resource('bank-sampah', BankSampahController::class);

        // Master Data - Jenis Sampah
        Route::resource('jenis-sampah', JenisSampahController::class);

        // Harga Standar
        Route::prefix('harga-standar')->name('harga-standar.')->group(function () {
            Route::get('/', [HargaStandarController::class, 'index'])->name('index');
            Route::get('/{jenisSampah}/edit', [HargaStandarController::class, 'edit'])->name('edit');
            Route::put('/{jenisSampah}', [HargaStandarController::class, 'update'])->name('update');
            Route::post('/bulk-update', [HargaStandarController::class, 'bulkUpdate'])->name('bulk-update');
            Route::get('/compare', [HargaStandarController::class, 'compare'])->name('compare');
            Route::get('/export', [HargaStandarController::class, 'export'])->name('export');
        });

        // Monitoring
        Route::prefix('monitoring')->name('monitoring.')->group(function () {
            Route::get('/', [MonitoringController::class, 'index'])->name('index');
            Route::get('/harga', [MonitoringController::class, 'harga'])->name('harga');
            Route::get('/transaksi', [MonitoringController::class, 'transaksi'])->name('transaksi');
            Route::get('/wilayah', [MonitoringController::class, 'wilayah'])->name('wilayah');
            Route::get('/log', [MonitoringController::class, 'logAktivitas'])->name('log');
        });

        // Laporan
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [AdminLaporanController::class, 'index'])->name('index');
            Route::get('/transaksi', [AdminLaporanController::class, 'transaksi'])->name('transaksi');
            Route::get('/jenis-sampah', [AdminLaporanController::class, 'jenisSampah'])->name('jenis-sampah');
            Route::get('/per-bank', [AdminLaporanController::class, 'perBank'])->name('per-bank');
            Route::get('/per-wilayah', [AdminLaporanController::class, 'perWilayah'])->name('per-wilayah');
            Route::get('/nilai-ekonomis', [AdminLaporanController::class, 'nilaiEkonomis'])->name('nilai-ekonomis');
        });
    });

/*
|--------------------------------------------------------------------------
| Bank Sampah Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:bank_sampah'])
    ->prefix('bank-sampah')
    ->name('bank-sampah.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [BankSampahDashboardController::class, 'index'])
            ->name('dashboard');

        // Transaksi Penyetoran
        Route::resource('penyetoran', PenyetoranController::class);
        Route::get('/penyetoran/harga/{jenisSampah}', [PenyetoranController::class, 'getHarga'])
            ->name('penyetoran.harga');

        // Transaksi Penjualan
        Route::resource('penjualan', PenjualanController::class);

        // Harga Bank
        Route::resource('harga', HargaBankController::class)->except(['show']);

        // Laporan
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [BankSampahLaporanController::class, 'index'])->name('index');
            Route::get('/harian', [BankSampahLaporanController::class, 'harian'])->name('harian');
            Route::get('/periode', [BankSampahLaporanController::class, 'periode'])->name('periode');
            Route::get('/bulanan', [BankSampahLaporanController::class, 'bulanan'])->name('bulanan');
            Route::get('/tahunan', [BankSampahLaporanController::class, 'tahunan'])->name('tahunan');
            Route::get('/jenis-sampah', [BankSampahLaporanController::class, 'jenisSampah'])->name('jenis-sampah');
        });
    });

Route::get('/seed-production', function() {
    if (app()->environment('production') && auth()->check()) {
        try {
            // Cek apakah sudah ada data
            if (\App\Models\Wilayah::count() == 0) {
                \Artisan::call('db:seed', ['--force' => true]);
                return 'Seeder berhasil dijalankan! Data sudah masuk.';
            }
            return 'Data sudah ada, tidak perlu seed lagi.';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    return 'Unauthorized atau bukan production';
})->name('seed.production');

Route::get('/clear-all', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return 'Cache cleared!';
});