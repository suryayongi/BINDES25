<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // 1. Tambahkan baris ini
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. Tambahkan "Gerbang Keamanan" di sini
        Gate::define('manage-products', function ($user) {
            // Hanya user dengan role 'admin' atau 'penjual' yang boleh lewat
            return in_array($user->role, ['admin', 'penjual']);
        });
    }
}