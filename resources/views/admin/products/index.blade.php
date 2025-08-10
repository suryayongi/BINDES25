@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Kelola Produk</h1>
        {{-- Tombol Tambah Produk hanya muncul jika user adalah PENJUAL --}}
        @if(auth()->user()->role === 'penjual')
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk Baru</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Penjual</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" width="100" class="img-thumbnail">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->user->name ?? 'N/A' }}</td>
                            <td>Rp{{ number_format($product->price, 0) }}</td>
                            <td>
                                {{-- Tombol Aksi (Edit/Hapus) hanya muncul untuk PENJUAL --}}
                                @if(auth()->user()->role === 'penjual')
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                                    </form>
                                @else
                                    {{-- Jika Admin, tampilkan teks ini --}}
                                    <span>Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada produk untuk ditampilkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection