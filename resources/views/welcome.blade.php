@extends('layouts.app')

@section('title', 'Selamat Datang di Etalase Digital Desa PasirLangu')

@push('styles')
<style>
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("{{ asset('images/bru tlmw (1).png') }}");
        background-size: cover;
        background-position: center;
        color: white;
    }
    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .card-img-top { height: 200px; object-fit: cover; }
    .map-container { position: relative; width: 100%; padding-bottom: 50%; height: 0; overflow: hidden; border-radius: .5rem; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .map-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }
    .feature-icon { font-size: 3rem; color: #0d6efd; }
</style>
@endpush

@section('content')
    {{-- Hero Section --}}
    <div class="hero-section text-center py-5 rounded-3 mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Temukan Harta Karun Tersembunyi dari PasirLangu</h1>
            <p class="fs-4 col-md-8 mx-auto">Setiap produk adalah cerita, setiap pembelian adalah dukungan. Jelajahi etalase kami dan jadilah bagian dari perjalanan warga lokal.</p>
            <a href="{{ route('etalase') }}" class="btn btn-primary btn-lg px-4">Lihat Semua Produk</a>
        </div>
    </div>

    {{-- Produk Unggulan --}}
    @if($featuredProducts->isNotEmpty())
    <div class="container px-4 py-5">
        <h2 class="pb-2 border-bottom text-center fw-bold">Produk Unggulan Kami</h2>
        <div class="row g-4 py-5">
            @foreach($featuredProducts as $product)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 product-card">
                    <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 70) }}</p>
                        <p class="card-text fs-5 fw-bold text-primary mt-auto">{{ $product->price }}</p>
                        <a href="{{ $product->product_url }}" target="_blank" class="btn btn-success mt-2">Lihat di Shopee</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Fitur Unggulan untuk Marketing (Ditambahkan Kembali) --}}
    <div class="container px-4 py-5 text-center">
        <h2 class="pb-2 border-bottom">Kenapa Harus Jelajah?</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16"><path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.638.622a2.89 2.89 0 0 0 0 4.134l.638.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89.01.622.638a2.89 2.89 0 0 0 4.134 0l.622-.638.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.638-.622a2.89 2.89 0 0 0 0-4.134l-.638-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89-.01zM6.854 10.854 4.854 8.854a.5.5 0 1 1 .708-.708L7.207 9.793l3.147-3.146a.5.5 0 1 1 .708.708z"/></svg>
                </div>
                <h3 class="fs-2">Produk Asli & Terkurasi</h3>
                <p>Kami memilih produk terbaik langsung dari tangan para pengrajin dan petani lokal.</p>
            </div>
            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16"><path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/></svg>
                </div>
                <h3 class="fs-2">Dukung Ekonomi Lokal</h3>
                <p>Setiap transaksi Anda memberikan dampak langsung bagi kesejahteraan warga desa kami.</p>
            </div>
            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-map-fill" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.598.49V15.5a.5.5 0 0 0 .598.49l4.902.98 4.902-.98a.5.5 0 0 0 .598-.49zM5 14.09V1.11l.51.1.9.18zM10 15l-4-1v-1.2l1.582.316a.5.5 0 0 0 .434-.011L10 12.55z"/></svg>
                </div>
                <h3 class="fs-2">Jelajahi Lokasi Kami</h3>
                <p>Lihat langsung keindahan Desa PasirLangu melalui peta interaktif di bawah ini.</p>
            </div>
        </div>
    </div>

    {{-- Peta Lokasi Desa --}}
    <div class="container px-4 py-5" id="map-section">
        <h2 class="pb-2 border-bottom text-center">Lokasi Desa PasirLangu</h2>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.43594199852!2d107.55019809647036!3d-6.909503418525701!2m3!1f0!2f0!3f0!3m2!i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e61e73a95a2d%3A0x1c36b0abe2c5c163!2sPasirlangu%2C%20Kec.%20Cisarua%2C%20Kabupaten%20Bandung%20Barat%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1721900000000!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
