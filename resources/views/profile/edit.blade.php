<x-app-layout>
    {{-- Menggunakan slot untuk header halaman --}}
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
                        <div class="card-header py-3">
                            <h5 class="mb-0">Informasi Profil</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="card-subtitle mb-3 text-muted">Perbarui informasi profil dan alamat email akun Anda.</p>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    {{-- Kartu untuk Update Password --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Ubah Password</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="card-subtitle mb-3 text-muted">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    {{-- Kartu untuk Hapus Akun --}}
                    <div class="card shadow-sm border-danger">
                        <div class="card-header bg-danger text-white py-3">
                            <h5 class="mb-0">Hapus Akun</h5>
                        </div>
                        <div class="card-body p-4">
                            <p class="card-subtitle mb-3 text-muted">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>