<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Tambahin ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Maksa kirim key dari .env ke semua file Blade
        View::share('clerk_pk', env('CLERK_PUBLISHABLE_KEY'));
    }
}