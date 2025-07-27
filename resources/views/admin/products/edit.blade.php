@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4>Edit Produk: {{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    {{-- Menampilkan pesan error validasi jika ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6 class="alert-heading">Terjadi Kesalahan!</h6>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form untuk mengirim data update --}}
                    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH') {{-- Method yang benar untuk update --}}
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Penjelasan Singkat</label>
                            <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Ganti Gambar (Opsional)</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image_url) }}" alt="Gambar saat ini" width="100" class="rounded">
                                <small class="d-block text-muted">Gambar saat ini</small>
                            </div>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="product_url" class="form-label">URL Produk Shopee</label>
                            <input type="url" class="form-control" id="product_url" name="product_url" value="{{ old('product_url', $product->product_url) }}" required>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
