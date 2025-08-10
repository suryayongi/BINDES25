@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container">
    <h1>Edit Produk: {{ $product->name }}</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH') {{-- Pastikan ini menggunakan PATCH --}}

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk (Opsional: ganti gambar)</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @if($product->image_url)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="Gambar saat ini" class="img-thumbnail" width="150">
                    <p class="form-text">Gambar saat ini.</p>
                </div>
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="product_url" class="form-label">URL Produk (opsional, misal link Shopee)</label>
            <input type="url" class="form-control @error('product_url') is-invalid @enderror" id="product_url" name="product_url" value="{{ old('product_url', $product->product_url) }}">
            @error('product_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Produk</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection