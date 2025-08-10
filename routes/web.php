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

// Halaman utama (welcome) sekarang menjadi publik untuk semua
Route::get('/', [PageController::class, 'welcome'])->name('home');

// Halaman etalase juga menjadi publik
Route::get('/etalase', [PageController::class, 'etalase'])->name('etalase');

// Dashboard hanya untuk yang sudah login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup rute yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:viewAny,App\Models\Product')->group(function () {
        Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::patch('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        // Rute baru untuk toggle featured product
        Route::patch('/admin/products/{product}/featured', [ProductController::class, 'toggleFeatured'])->name('admin.products.featured');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
        Route::patch('/admin/users/{user}', [AdminController::class, 'updateRole'])->name('admin.users.update');
    });
});

require __DIR__.'/auth.php';