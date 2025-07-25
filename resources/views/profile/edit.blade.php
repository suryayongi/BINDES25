<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold">
            Pengaturan Akun
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-8">
                    {{-- Kartu untuk Informasi Profil --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4 p-md-5">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    {{-- Kartu untuk Update Password --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-body p-4 p-md-5">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    {{-- Kartu untuk Hapus Akun --}}
                    <div class="card shadow-sm border-danger">
                        <div class="card-body p-4 p-md-5">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>