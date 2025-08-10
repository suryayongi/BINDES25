@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="container">
    <div class="row">
        @can('create', App\Models\Product::class)
            <div class="col-lg-4">
                {{-- Form Tambah Produk --}}
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white"><h4>Tambah Produk Baru</h4></div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- ... form input tetap sama ... --}}
                            <div class="mb-3"><label for="name" class="form-label">Nama Produk</label><input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required></div>
                            <div class="mb-3"><label for="price" class="form-label">Harga</label><input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" required></div>
                            <div class="mb-3"><label for="description" class="form-label">Penjelasan Singkat</label><textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description') }}</textarea></div>
                            <div class="mb-3"><label for="image" class="form-label">Upload Gambar</label><input type="file" class="form-control" id="image" name="image" required></div>
                            <div class="mb-3"><label for="product_url" class="form-label">URL Produk Shopee</label><input type="url" class="form-control" id="product_url" name="product_url" value="{{ old('product_url') }}" required></div>
                            <div class="d-grid"><button type="submit" class="btn btn-primary">Simpan Produk</button></div>
                        </form>
                    </div>
                </div>
            </div>
        @endcan

        <div class="@if(Auth::user()->role == 'admin') col-lg-12 @else col-lg-8 @endif">
            <div class="card shadow-sm">
                <div class="card-header"><h4>@if(Auth::user()->role == 'admin') Daftar Semua Produk @else Daftar Produk Anda @endif</h4></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    @if(Auth::user()->role == 'admin')
                                        <th>Penjual</th>
                                    @endif
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td><img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" width="60" class="rounded"></td>
                                        <td>{{ $product->name }}</td>
                                        @if(Auth::user()->role == 'admin')
                                            <td>{{ $product->user->name }}</td>
                                        @endif
                                        <td>
                                            @if($product->is_featured)
                                                <span class="badge bg-success">Unggulan</span>
                                            @else
                                                <span class="badge bg-secondary">Biasa</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 flex-wrap">
                                                @can('update', $product)
                                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    {{-- Form untuk toggle featured --}}
                                                    <form action="{{ route('admin.products.featured', $product) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-info btn-sm text-white">
                                                            {{ $product->is_featured ? 'Batal Unggulan' : 'Jadikan Unggulan' }}
                                                        </button>
                                                    </form>
                                                @endcan

                                                @can('delete', $product)
                                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                @endcan

                                                @if(Auth::user()->role == 'admin')
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
