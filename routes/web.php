<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rute Publik
Route::get('/', [PageController::class, 'welcome'])->name('home');
Route::get('/etalase', [PageController::class, 'etalase'])->name('etalase');

// Rute Autentikasi Bawaan
require __DIR__.'/auth.php';

// Rute yang Membutuhkan Login
Route::middleware('auth')->group(function () {

    // Rute Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // GRUP RUTE PRODUK (Untuk Admin & Penjual)
    Route::prefix('admin/products')->name('admin.products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
        Route::patch('/{product}/featured', [ProductController::class, 'toggleFeatured'])->name('featured');
    });

    // GRUP RUTE KHUSUS ADMIN (Manajemen User)
    Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('users', [AdminController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.update');
    });

});