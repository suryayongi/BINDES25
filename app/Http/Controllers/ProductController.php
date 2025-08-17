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

    /**
     * INI METHOD YANG HILANG.
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_url' => 'nullable|url',
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

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('admin.products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'product_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $validatedData['image_url'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        // $this->authorize('delete', $product);

        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
    
    public function toggleFeatured(Product $product)
    {
        $this->authorize('update', $product); 

        $product->is_featured = !$product->is_featured;
        $product->save();
        
        return redirect()->route('admin.products.index')->with('success', 'Status produk unggulan berhasil diubah!');
    }
}