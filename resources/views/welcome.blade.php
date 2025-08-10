@extends('layouts.app')

@section('title', 'Selamat Datang di Website UMKM Desa Pasirlangu')

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{ asset('images/bru tlmw (1).png') }}");
        background-size: cover;
        background-position: center;
        padding: 8rem 0;
        color: white;
        text-align: center;
    }

    /* Tentang Desa Section */
    .tentang-desa-section {
        padding: 4rem 0;
        background-color: #ffffff;
    }
    .tentang-desa-section .feature-box {
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 0.5rem;
        text-align: center;
        height: 100%;
    }

    /* Kepala Desa Section */
    .kepala-desa-section {
        padding: 4rem 0;
        background-color: #FFFBEB; /* Warna kuning dari desain */
        border-top-left-radius: 50px;
    }
    .kepala-desa-section img {
        max-width: 100%;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
</style>
@endpush

@section('content')
    {{-- 1. Hero Section --}}
    <section class="hero-section rounded-3 mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold">Wilujeng Sumping</h1>
            <p class="fs-4 col-md-8 mx-auto">di website UMKM Desa Pasirlangu!</p>
            <a href="{{ route('etalase') }}" class="btn btn-custom-yellow mt-3">Jelajahi Produk</a>
        </div>
    </section>

    {{-- 2. Tentang Desa Section --}}
    <section class="tentang-desa-section">
        <div class="container text-center">
            <h2 class="fw-bold">Tentang Desa Pasirlangu</h2>
            <p class="lead text-muted col-md-8 mx-auto">
                Pasirlangu adalah sebuah desa di Kecamatan Cisarua, Kabupaten Bandung Barat, Jawa Barat, Indonesia. Terkenal dengan keindahan alamnya dan kreativitas warganya dalam mengembangkan produk UMKM.
            </p>
            <div class="row mt-5 g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <h5>Visi Desa</h5>
                        <p>Menjadi desa agrowisata yang mandiri, sejahtera, dan berbudaya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <h5>Misi Desa</h5>
                        <p>Mengembangkan potensi lokal melalui UMKM dan pariwisata berbasis masyarakat.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <h5>Produk Unggulan</h5>
                        <p>Keripik, aneka olahan susu, kerajinan tangan, dan hasil pertanian organik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 3. Kepala Desa Section (Sesuai Permintaanmu) --}}
    <section class="kepala-desa-section my-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 text-center">
                    {{-- Ganti 'https://via.placeholder.com/400' dengan path gambar kepala desa jika sudah ada --}}
                    <img src="{{ asset('images/bru tlmw (1).png') }}" alt="Foto Kepala Desa Pasirlangu">
                </div>
                <div class="col-lg-7">
                    <h3 class="fw-bold">Kepala Desa Pasirlangu</h3>
                    <h4 class="fw-bold mb-3" style="color: var(--primary-red);">Bapak Tom Maverick</h4>
                    <p class="text-muted">
                        "Dengan semangat gotong royong, kami terus berinovasi untuk membawa produk-produk terbaik dari Desa Pasirlangu ke panggung yang lebih luas. Setiap pembelian Anda adalah dukungan berharga bagi kami untuk terus maju dan berkembang. Mari bersama-sama kita majukan ekonomi lokal."
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- 4. Peta Lokasi Desa --}}
    <section class="lokasi-desa-section py-5">
        <div class="container text-center">
            <h2 class="fw-bold">Lokasi Desa</h2>
            <p class="lead text-muted mb-4">Kunjungi kami dan nikmati keindahan alam serta keramahan warga Desa Pasirlangu.</p>
            <div class="map-container" style="border-radius: 1rem; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.43594199852!2d107.55019809647036!3d-6.909503418525701!2m3!1f0!2f0!3f0!3m2!i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e61e73a95a2d%3A0x1c36b0abe2c5c163!2sPasirlangu%2C%20Kec.%20Cisarua%2C%20Kabupaten%20Bandung%20Barat%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1721900000000!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
@endsection