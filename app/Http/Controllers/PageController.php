<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function etalase(): View
    {
        // Ambil semua produk, lalu kelompokkan berdasarkan user_id (penjual)
        $productsBySeller = Product::with('user')->get()->groupBy('user_id');

        return view('pages.etalase', ['productsBySeller' => $productsBySeller]);
    }
}