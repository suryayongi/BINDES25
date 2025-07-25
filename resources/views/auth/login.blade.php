<x-guest-layout>
    <h2 class="auth-title">Silahkan Login Terlebih Dahulu!</h2>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="email">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label for="password" class="form-label">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-decoration-none" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
        </div>

        <!-- Tombol Login -->
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-custom">
                Login
            </button>
        </div>
    </form>
    
    <p class="text-center mt-4">
        Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar Sekarang</a>
    </p>
</x-guest-layout>
