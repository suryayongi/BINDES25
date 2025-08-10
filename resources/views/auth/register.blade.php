<x-guest-layout>
    <h2 class="text-center fw-bold mb-4" style="color: var(--text-dark);">Daftar Akun Baru</h2>

    {{-- BLOK UNTUK MENAMPILKAN SEMUA ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Oops! Terjadi kesalahan.</h4>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Nomor Telepon</label>
            <input id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" type="text" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="tel" placeholder="Contoh: 081234567890" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" />
            <div id="passwordHelp" class="form-text">Minimal 8 karakter.</div>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="d-grid mt-4">
             <button type="submit" class="btn btn-custom-red">
                {{ __('Daftar') }}
            </button>
        </div>

        <div class="text-center mt-3">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}" style="text-decoration: none;">
                Sudah punya akun? Masuk
            </a>
        </div>
    </form>
</x-guest-layout>