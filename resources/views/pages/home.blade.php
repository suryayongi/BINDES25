@extends('layouts.app')

@section('title', 'Selamat Datang di Etalase Digital Desa PasirLangu')

@push('styles')
<style>
    /* CSS Kustom khusus untuk Homepage */
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1932&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 8rem 0;
        text-align: center;
    }
    .hero-section h1 {
        font-size: 3.5rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    .hero-section p {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }
    .btn-hero {
        font-size: 1.2rem;
        padding: 0.8rem 2.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }
    .features-section {
        padding: 4rem 0;
    }
    .feature-icon {
        font-size: 3rem;
        color: #0d6efd; /* Warna biru Bootstrap */
    }
</style>
@endpush

@section('content')
    {{-- Bagian Hero --}}
    <div class="hero-section rounded-3 mb-4">
        <div class="container">
            <h1 class="display-4">Etalase Digital Desa PasirLangu</h1>
            <p class="lead">Menampilkan Karya dan Produk Unggulan dari Jantung Kreativitas Warga Lokal.</p>
            <a href="{{ route('etalase') }}" class="btn btn-primary btn-lg btn-hero">
                Jelajahi Produk Kami
            </a>
        </div>
    </div>

 
    <div class="features-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-patch-check-fill feature-icon mb-3" viewBox="0 0 16 16">
                        <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.638.622a2.89 2.89 0 0 0 0 4.134l.638.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89.01.622.638a2.89 2.89 0 0 0 4.134 0l.622-.638.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.638-.622a2.89 2.89 0 0 0 0-4.134l-.638-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89-.01zM6.854 10.854 4.854 8.854a.5.5 0 1 1 .708-.708L7.207 9.793l3.147-3.146a.5.5 0 1 1 .708.708z"/>
                    </svg>
                    <h3>Kualitas Terjamin</h3>
                    <p class="text-muted">Produk pilihan yang telah melewati kurasi untuk memastikan kualitas terbaik.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-people-fill feature-icon mb-3" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                    </svg>
                    <h3>Dibuat oleh Warga Lokal</h3>
                    <p class="text-muted">Mendukung langsung perekonomian dan kreativitas masyarakat Desa PasirLangu.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-cart-check-fill feature-icon mb-3" viewBox="0 0 16 16">
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708"/>
                    </svg>
                    <h3>Transaksi Aman</h3>
                    <p class="text-muted">Pembelian tetap dilakukan melalui platform Shopee yang sudah terjamin keamanannya.</p>
                </div>
            </div>
        </div>
    </div>
@endsection