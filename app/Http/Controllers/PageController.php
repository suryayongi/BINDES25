<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Menampilkan halaman utama (welcome) untuk semua pengunjung.
     */
    public function welcome(): View
    {
        // Logika untuk menampilkan produk unggulan di halaman utama
        $featuredProducts = Product::where('is_featured', true)->inRandomOrder()->take(6)->get();
        
        return view('welcome', ['featuredProducts' => $featuredProducts]);
    }

    /**
     * Menampilkan halaman etalase dengan fungsionalitas search.
     */
    public function etalase(Request $request): View
    {
        $query = Product::query()->with('user');

        // Logika untuk search
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->get();

        return view('pages.etalase', compact('products'));
    }
}