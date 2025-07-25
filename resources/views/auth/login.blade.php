<x-guest-layout>
    <h2 class="auth-title">Admin Login</h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Username</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label for="password" class="form-label">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-decoration-none" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                @endif
            </div>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-custom">
                Login
            </button>
        </div>
    </form>

    <p class="text-center mt-4">
        Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register Now</a>
    </p>
</x-guest-layout>