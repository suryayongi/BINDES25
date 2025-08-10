<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    // Hapus __construct() yang ada di sini

    /**
     * Menampilkan halaman utama (welcome) untuk semua pengunjung.
     */
    public function welcome(): View
    {
        // Ambil 6 produk yang ditandai sebagai unggulan secara acak
        $featuredProducts = Product::where('is_featured', true)->inRandomOrder()->take(6)->get();
        
        return view('welcome', ['featuredProducts' => $featuredProducts]);
    }

    /**
     * Menampilkan halaman etalase.
     */
    public function etalase(): View
    {
        $productsBySeller = Product::with('user')->get()->groupBy('user_id');
        return view('pages.etalase', ['productsBySeller' => $productsBySeller]);
    }
}