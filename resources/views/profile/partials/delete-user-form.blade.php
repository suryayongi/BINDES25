<section class="space-y-6">
    <header>
        <h2 class="h5 fw-bold text-danger">
            Hapus Akun
        </h2>

        <p class="mt-1 text-muted">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
    </header>

    <button 
        type="button" 
        class="btn btn-danger" 
        data-bs-toggle="modal" 
        data-bs-target="#confirm-user-deletion">
        Hapus Akun
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="confirm-user-deletion-label">
                        Apakah Anda yakin ingin menghapus akun Anda?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                    </p>

                    <div class="mt-3">
                        <label for="password-delete" class="form-label visually-hidden">Password</label>
                        <input 
                            id="password-delete" 
                            name="password" 
                            type="password" 
                            class="form-control" 
                            placeholder="Password"
                        >
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-danger" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</section>