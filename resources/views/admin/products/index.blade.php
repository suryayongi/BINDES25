@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Kelola Produk</h1>
        @if(auth()->user()->role === 'penjual')
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk Baru</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            @if(auth()->user()->role === 'admin')
                                <th>Penjual</th>
                            @endif
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" width="100" class="img-thumbnail">
                            </td>
                            <td>{{ $product->name }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td>{{ $product->user->name ?? 'N/A' }}</td>
                            @endif
                            <td>Rp{{ number_format($product->price, 0) }}</td>
                            <td>
                                @if($product->is_featured)
                                    <span class="badge bg-success">Unggulan</span>
                                @else
                                    <span class="badge bg-secondary">Biasa</span>
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->role === 'penjual')
                                    <form action="{{ route('admin.products.featured', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $product->is_featured ? 'btn-info' : 'btn-outline-info' }}" title="{{ $product->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}">
                                            ⭐
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    
                                    {{-- PERBAIKAN DI SINI --}}
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus produk ini?')">Hapus</button>
                                    </form>

                                @else
                                    <span>Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada produk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection