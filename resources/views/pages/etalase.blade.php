@extends('layouts.app')

@section('title', 'Etalase Produk Desa PasirLangu')

@push('styles')
<style>
    .product-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .toko-header {
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        font-weight: bold;
    }
</style>
@endpush

@section('content')
    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
        <div class="container-fluid py-3">
            <h1 class="display-5 fw-bold">Etalase Produk Unggulan</h1>
            <p class="col-md-8 fs-4">Jelajahi produk-produk terbaik hasil karya UMKM Desa PasirLangu.</p>
        </div>
    </div>

    @forelse ($productsBySeller as $sellerId => $products)
        <div class="mb-5">
            {{-- Tampilkan Nama Toko/Penjual --}}
            <h2 class="toko-header">Toko: {{ $products->first()->user->name }}</h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product-card">
                            <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($product->name, 50) }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 70) }}</p>
                                <p class="card-text fw-bold fs-5 text-primary mt-auto">{{ $product->price }}</p>
                                <a href="{{ $product->product_url }}" target="_blank" class="btn btn-success">
                                    Lihat di Shopee
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="text-center p-5 bg-light rounded">
                <h2>Produk Segera Hadir</h2>
                <p class="lead text-muted">Saat ini belum ada produk yang ditampilkan. Silakan berkunjung kembali nanti!</p>
            </div>
        </div>
    @endforelse
@endsection