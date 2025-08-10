@extends('layouts.app')

@section('title', 'Etalase Produk Desa PasirLangu')

@push('styles')
<style>
    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .card-img-top { height: 220px; object-fit: cover; }
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
</style>
@endpush

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
            <h1 class="display-5 fw-bold">Etalase Produk Unggulan</h1>
            <p class="col-md-8 fs-4">Jelajahi produk-produk terbaik hasil karya UMKM Desa PasirLangu.</p>
        </div>
    </div>

    @forelse ($productsBySeller as $sellerId => $products)
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h2 class="toko-header">Toko: {{ $products->first()->user->name }}</h2>
                {{-- Tombol WhatsApp --}}
                @if($products->first()->user->phone_number)
                    <a href="https://wa.me/62{{ substr($products->first()->user->phone_number, 0, 1) == '0' ? substr($products->first()->user->phone_number, 1) : $products->first()->user->phone_number }}" target="_blank" class="btn btn-outline-success mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp me-2" viewBox="0 0 16 16"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg>
                        Hubungi Penjual
                    </a>
                @endif
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 product-card">
                            <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ Str::limit($product->name, 50) }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($product->description, 70) }}</p>
                                <p class="card-text fs-5 fw-bold text-primary mt-auto">{{ $product->price }}</p>
                                <a href="{{ $product->product_url }}" target="_blank" class="btn btn-success mt-2">Lihat di Shopee</a>
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
