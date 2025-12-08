<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\Wilayah;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS di production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // View Composer untuk dropdown Wilayah di semua halaman admin.bank-sampah.*
        View::composer('admin.bank-sampah.*', function ($view) {
            $view->with('wilayah', Wilayah::active()->get());
        });
    }
}
