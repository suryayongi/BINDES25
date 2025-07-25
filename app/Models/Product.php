<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description', // Ditambahkan
        'image_url',
        'product_url',
        'user_id', // Ditambahkan
    ];

    /**
     * Mendapatkan user (penjual) yang memiliki produk ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}