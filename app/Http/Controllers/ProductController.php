<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Jika admin, tampilkan semua. Jika penjual, tampilkan miliknya saja.
        if (auth()->user()->role === 'admin') {
            $products = Product::latest()->get();
        } else {
            $products = auth()->user()->products()->latest()->get();
        }

        return view('admin.products.index', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_url' => 'required|url',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        // Simpan produk dengan menyertakan user_id dan description
        auth()->user()->products()->create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_url' => $imagePath,
            'product_url' => $request->product_url,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Fungsi baru untuk menghapus produk.
     */
    public function destroy(Product $product)
    {
        // Otorisasi: pastikan hanya pemilik atau admin yang bisa menghapus
        $this->authorize('delete', $product);

        // Hapus file gambar dari storage
        Storage::disk('public')->delete($product->image_url);

        // Hapus data dari database
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}