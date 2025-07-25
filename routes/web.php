<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk halaman publik yang bisa diakses semua orang
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/etalase', [PageController::class, 'etalase'])->name('etalase');


// Rute bawaan Breeze untuk dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Grup rute yang hanya bisa diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {
    // Rute untuk halaman profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk halaman admin "Kelola Produk"
    // Diamankan oleh Gate 'manage-products'
    Route::get('/admin/products', [ProductController::class, 'index'])
        ->name('admin.products.index')->middleware('can:manage-products');

    Route::post('/admin/products', [ProductController::class, 'store'])
        ->name('admin.products.store')->middleware('can:manage-products');
    
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])
    ->name('admin.products.destroy')->middleware('can:manage-products');
});


// File rute untuk autentikasi (login, register, logout, dll.)
require __DIR__.'/auth.php';