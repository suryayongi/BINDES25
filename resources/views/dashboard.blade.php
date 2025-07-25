<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">

            {{-- ====================================================== --}}
            {{-- KONTEN DINAMIS BERDASARKAN ROLE USER --}}
            {{-- ====================================================== --}}

            @if(Auth::user()->role == 'pembeli')

                {{-- TAMPILAN BARU DAN KEREN UNTUK PEMBELI --}}
                <div class="p-5 mb-4 bg-white rounded-3 shadow-sm text-center">
                    <h1 class="display-5 fw-bold">Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
                    <p class="fs-4 col-md-10 mx-auto">Terima kasih telah menjadi bagian dari komunitas kami. Mari lanjutkan penjelajahan Anda.</p>
                </div>

                <div class="row align-items-md-stretch g-4">
                    {{-- Kolom Sejarah --}}
                    <div class="col-lg-7">
                        <div class="h-100 p-5 bg-white rounded-3 shadow-sm d-flex flex-column">
                            <h2>Sekilas Sejarah Desa PasirLangu</h2>
                            <p>Desa PasirLangu, yang terletak di Kecamatan Cisarua, Kabupaten Bandung Barat, memiliki sejarah panjang yang kaya akan budaya dan tradisi agraris. Berada di ketinggian yang sejuk, desa ini sejak dulu dikenal sebagai penghasil sayur-mayur berkualitas tinggi. Kini, semangat gotong royong dan kreativitas warganya terwujud dalam bentuk produk UMKM unik yang siap Anda jelajahi.</p>
                            <a href="{{ route('etalase') }}" class="btn btn-primary btn-lg mt-auto align-self-start">Lihat Etalase Produk</a>
                        </div>
                    </div>
                    {{-- Kolom Peta --}}
                    <div class="col-lg-5">
                        <div class="h-100 p-5 bg-dark rounded-3 shadow-sm text-white">
                            <h2>Lokasi Kami</h2>
                            <p>Temukan kami di peta dan rasakan langsung suasana sejuk Desa PasirLangu.</p>
                            <div class="map-container" style="padding-bottom: 75%; border-radius: .3rem; position: relative; width: 100%; height: 0; overflow: hidden;">
                                {{-- URL Peta yang sudah diperbaiki --}}
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.43594199852!2d107.55019809647036!3d-6.909503418525701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e61e73a95a2d%3A0x1c36b0abe2c5c163!2sPasirlangu%2C%20Kec.%20Cisarua%2C%20Kabupaten%20Bandung%20Barat%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1721900000000!5m2!1sid!2sid" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

            @else

                {{-- TAMPILAN FUNGSIONAL UNTUK ADMIN & PENJUAL --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-4">
                    <div class="p-4 p-md-5 text-dark">
                        <h1 class="display-6 fw-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
                        <p class="fs-5 text-muted">Selamat beraktivitas di Dasbor E-Commerce Desa PasirLangu.</p>
                    </div>
                </div>

                <div class="row">
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

                    @if(Auth::user()->role == 'admin')
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title">Manajemen User</h5>
                                <p class="card-text">Atur dan ubah peran pengguna yang terdaftar di website.</p>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-info text-white">Kelola User</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            @endif

        </div>
    </div>
</x-app-layout>
