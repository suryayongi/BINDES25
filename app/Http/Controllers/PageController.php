<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Menampilkan halaman utama (welcome).
     */
    public function welcome(): View
    {
        $featuredProducts = Product::where('is_featured', true)->inRandomOrder()->take(6)->get();
        return view('welcome', ['featuredProducts' => $featuredProducts]);
    }

    /**
     * Menampilkan halaman etalase dengan produk yang dikelompokkan per penjual.
     */
    public function etalase(Request $request): View
    {
        $query = Product::with('user')->latest();

        // Logika search jika ada
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Ambil semua produk yang cocok, LALU kelompokkan berdasarkan user_id penjual
        $productsBySeller = $query->get()->groupBy('user_id');

        return view('pages.etalase', compact('productsBySeller'));
    }
}