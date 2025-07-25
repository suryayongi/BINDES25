<x-guest-layout>
    <h2 class="auth-title">Admin Register</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name of Person in Charge *</label>
            <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Example: Asep Sutisna">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Example@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number *</label>
            <div class="input-group">
                <span class="input-group-text">+62</span>
                <input id="phone_number" class="form-control" type="text" name="phone_number" :value="old('phone_number')" required placeholder="8xx xxxx xxxx">
            </div>
             <x-input-error :messages="$errors->get('phone_number')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password *</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password *</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-custom">
                Register
            </button>
        </div>
    </form>

    <p class="text-center mt-4">
        Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Log in Now</a>
    </p>
</x-guest-layout>