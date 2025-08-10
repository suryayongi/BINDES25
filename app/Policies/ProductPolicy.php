<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Tentukan apakah user bisa melihat SEMUA produk (halaman index).
     * Diizinkan untuk admin DAN penjual.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'penjual';
    }

    /**
     * Tentukan apakah user bisa melihat SATU produk spesifik.
     */
    public function view(User $user, Product $product): bool
    {
        // Izinkan jika user adalah admin ATAU pemilik produk
        return $user->role === 'admin' || $user->id === $product->user_id;
    }

    /**
     * Tentukan apakah user bisa membuat produk baru.
     * Hanya penjual yang bisa.
     */
    public function create(User $user): bool
    {
        return $user->role === 'penjual';
    }

    /**
     * Tentukan apakah user bisa mengupdate produk.
     */
    public function update(User $user, Product $product): bool
    {
        // Izinkan jika user adalah admin ATAU pemilik produk
        return $user->role === 'admin' || $user->id === $product->user_id;
    }

    /**
     * Tentukan apakah user bisa menghapus produk.
     */
    public function destroy(User $user, Product $product): bool
    {
        // Izinkan jika user adalah admin ATAU pemilik produk
        return $user->role === 'admin' || $user->id === $product->user_id;
    }
}