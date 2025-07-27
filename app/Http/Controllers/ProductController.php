<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Product::class);

        if (auth()->user()->role === 'admin') {
            $products = Product::with('user')->latest()->get();
        } else {
            $products = auth()->user()->products()->latest()->get();
        }
        
        return view('admin.products.index', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_url' => 'required|url',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

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
     * Fungsi baru untuk menampilkan halaman edit produk.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);

        return view('admin.products.edit', ['product' => $product]);
    }

    /**
     * Fungsi baru untuk memproses update produk.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Gambar tidak wajib diisi saat update
            'product_url' => 'required|url',
        ]);

        // Cek jika ada file gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($product->image_url);
            // Upload gambar baru dan simpan path-nya
            $validatedData['image_url'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        Storage::disk('public')->delete($product->image_url);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
