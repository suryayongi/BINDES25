<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Izinkan admin melakukan apa saja (kecuali membuat, mengedit, menghapus).
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === 'admin') {
            // Admin boleh melihat, tapi tidak boleh melakukan aksi lain
            return in_array($ability, ['viewAny']);
        }
        return null;
    }

    /**
     * Tentukan apakah user bisa melihat halaman kelola produk.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'penjual']);
    }

    /**
     * Tentukan apakah user bisa membuat produk baru.
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
        // Hanya boleh jika produk ini milik user tersebut DAN role-nya adalah penjual
        return $user->id === $product->user_id && $user->role === 'penjual';
    }

    /**
     * Tentukan apakah user bisa menghapus produk.
     */
    public function delete(User $user, Product $product): bool
    {
        // Hanya boleh jika produk ini milik user tersebut DAN role-nya adalah penjual
        return $user->id === $product->user_id && $user->role === 'penjual';
    }
}
