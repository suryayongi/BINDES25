<x-app-layout>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Etalase Produk Desa</h1>
            <p class="text-muted">Cari dan temukan produk unggulan dari para pengrajin dan petani di Desa Pasirlangu.</p>
            <form action="{{ route('etalase') }}" method="GET" class="mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Contoh: Keripik Singkong" value="{{ request('search') }}">
                            <button class="btn btn-custom-red" type="submit">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="color: var(--text-green);">{{ $product->name }}</h5>
                            <p class="card-text text-muted mb-2">Oleh: {{ $product->user->name }}</p>
                            <p class="card-text fw-bold fs-5">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                             <div class="d-grid">
                                <a href="#" class="btn btn-custom-yellow">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <h4>Oops! Produk tidak ditemukan.</h4>
                        <p>Coba gunakan kata kunci lain atau lihat semua produk.</p>
                        <a href="{{ route('etalase') }}" class="btn btn-custom-red mt-3">Lihat Semua Produk</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>