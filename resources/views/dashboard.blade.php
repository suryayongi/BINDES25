<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            {{-- Pesan Selamat Datang yang Personal --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-4">
                <div class="p-4 p-md-5 text-dark">
                    <h1 class="display-6 fw-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="fs-5 text-muted">Selamat beraktivitas di Dasbor E-Commerce Desa PasirLangu.</p>
                </div>
            </div>

            {{-- Kartu Aksi Cepat Berdasarkan Role User --}}
            <div class="row">
                {{-- Aksi untuk Semua User --}}
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Jelajahi Produk</h5>
                            <p class="card-text">Lihat semua produk unggulan dari UMKM desa kami.</p>
                            <a href="{{ route('etalase') }}" class="btn btn-primary">Lihat Etalase</a>
                        </div>
                    </div>
                </div>

                {{-- Aksi Khusus untuk Penjual & Admin --}}
                @can('manage-products')
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Kelola Produk Anda</h5>
                            <p class="card-text">Tambah, lihat, atau edit produk yang Anda jual di etalase.</p>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-success">Kelola Produk</a>
                        </div>
                    </div>
                </div>
                @endcan

                {{-- Aksi Khusus untuk Pembeli --}}
                @if(Auth::user()->role == 'pembeli')
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Profil Saya</h5>
                            <p class="card-text">Perbarui informasi data diri dan alamat Anda.</p>
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Edit Profil</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>