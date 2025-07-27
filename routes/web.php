<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama: beda tampilan untuk tamu dan user yang sudah login
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard'); // Jika sudah login, ke dashboard
    }
    return view('welcome'); // Jika tamu, ke halaman welcome
})->name('home');

// Halaman etalase (sekarang terkunci, hanya untuk yang sudah login)
Route::get('/etalase', [PageController::class, 'etalase'])->name('etalase');

// Dashboard bawaan Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup rute yang butuh login
Route::middleware('auth')->group(function () {
    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GRUP RUTE PRODUK YANG DIPERBARUI ---
    // Middleware ini sekarang menggunakan Policy untuk memeriksa apakah user (Admin/Penjual) boleh melihat halaman ini
    Route::middleware('can:viewAny,App\Models\Product')->group(function () {
        Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
        
        // Rute baru untuk menampilkan halaman edit
        Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        // Rute baru untuk memproses update
        Route::patch('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');

        Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });

    // Grup rute khusus untuk admin (Manajemen User)
    Route::middleware('admin')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
        Route::patch('/admin/users/{user}', [AdminController::class, 'updateRole'])->name('admin.users.update');
    });
});

// File rute untuk autentikasi
require __DIR__.'/auth.php';
