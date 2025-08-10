<x-app-layout>
    @push('styles')
    <style>
        .product-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            border: none;
            border-radius: 1rem;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        .seller-section h2 {
            color: var(--primary-maroon, #8B1E24);
        }
        .modal-header, .modal-footer {
            border: none;
        }
    </style>
    @endpush

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

        @forelse ($productsBySeller as $sellerId => $products)
            <div class="seller-section mb-5">
                <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                    <h2 class="fw-bold mb-0 me-3">Toko: {{ $products->first()->user->name }}</h2>
                    <a href="https://wa.me/{{ $products->first()->user->phone_number }}" target="_blank" class="btn btn-success btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp me-1" viewBox="0 0 16 16"><path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/></svg> Hubungi Penjual
                    </a>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card h-100 product-card">
                                <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                                
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold" style="color: var(--text-dark);">{{ $product->name }}</h5>
                                    <p class="card-text fw-bold fs-5 mb-3" style="color: var(--primary-maroon);">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                    
                                    <div class="mt-auto">
                                        <button type="button" class="btn btn-custom-yellow w-100" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content" style="border-radius: 1rem;">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <img src="{{ asset('storage/' . $product->image_url) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Penjual:</strong> {{ $product->user->name }}</p>
                                                <p class="fs-4 fw-bold" style="color: var(--primary-maroon);">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                                <hr>
                                                <p><strong>Deskripsi Produk:</strong></p>
                                                <p>{{ $product->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        {{-- TOMBOL BARU "BELI DI SHOPEE" --}}
                                        @if($product->product_url)
                                        <a href="{{ $product->product_url }}" target="_blank" class="btn btn-warning fw-bold">
                                            Beli di Shopee
                                        </a>
                                        @endif
                                        <a href="https://wa.me/{{ $product->user->phone_number }}?text=Halo, saya tertarik dengan produk {{ $product->name }}" target="_blank" class="btn btn-success">
                                            Tanya via WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <h4>Oops! Produk tidak ditemukan.</h4>
                    <p>Silakan coba cari dengan kata kunci lain.</p>
                </div>
            </div>
        @endforelse
    </div>
</x-app-layout>