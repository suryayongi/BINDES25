<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Izinkan admin melakukan apa saja.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === 'admin') {
            return true;
        }
        return null;
    }

    /**
     * Tentukan apakah user bisa menghapus produk.
     */
    public function delete(User $user, Product $product): bool
    {
        // Hanya boleh jika produk ini milik user tersebut
        return $user->id === $product->user_id;
    }
}