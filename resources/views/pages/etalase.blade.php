@extends('layouts.app')

@section('title', 'Etalase Produk Desa PasirLangu')

@push('styles')
<style>
    .hero-etalase {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{ asset('images/Testerrr.jpg') }}");
        background-size: cover;
        background-position: center;
    }
    .product-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border: none;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
    }
    .card-img-top {
        height: 220px;
        object-fit: cover;
    }
    .toko-header {
        font-weight: 700;
        font-size: 2rem;
        position: relative;
        padding-bottom: 0.75rem;
        margin-bottom: 2rem;
    }
    .toko-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background-color: #0d6efd;
        border-radius: 2px;
    }
    .card-title {
        font-weight: 600;
    }
    .card-text.price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0d6efd;
    }
    .btn-shopee {
        background-color: #28a745;
        border-color: #28a745;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
    {{-- Header Halaman Etalase Baru --}}
    <div class="p-5 mb-4 hero-etalase text-white rounded-3 shadow-lg">
        <div class="container-fluid py-5">
            <h1 class="display-4 fw-bold">Etalase Produk Unggulan</h1>
            <p class="col-md-8 fs-4">Jelajahi dan temukan produk-produk terbaik hasil karya UMKM Desa PasirLangu. Setiap pembelian Anda turut mendukung perekonomian lokal.</p>
        </div>
    </div>

    @forelse ($productsBySeller as $sellerId => $products)
        <div class="mb-5">
            {{-- Header Toko yang Lebih Keren --}}
            <h2 class="toko-header">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-shop me-2" viewBox="0 0 16 16">
                  <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 5.875 8a2.37 2.37 0 0 1-1.625-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
                </svg>
                Toko: {{ $products->first()->user->name }}
            </h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product-card">
                            <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($product->name, 50) }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($product->description, 70) }}</p>
                                <p class="card-text price mt-auto">{{ $product->price }}</p>
                                <a href="{{ $product->product_url }}" target="_blank" class="btn btn-success btn-shopee mt-2">
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
