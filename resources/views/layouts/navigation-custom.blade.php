<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Karya Pasirlangu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('etalase') ? 'active' : '' }}" href="{{ route('etalase') }}">Produk</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                @guest
                    {{-- Menu ini HANYA tampil jika PENGGUNA BELUM LOGIN --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                         <a href="{{ route('register') }}" class="btn btn-custom-red ms-2" style="color: white; text-decoration: none; padding: 0.5rem 1rem;">Daftar</a>
                    </li>
                @endguest

                @auth
                    {{-- Menu ini HANYA tampil jika PENGGUNA SUDAH LOGIN --}}
                    @if(Auth::user()->role == 'pembeli')
                        <li class="nav-item">
                           <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Halo, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->role == 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Manajemen User</a></li>
                            @endif
                            
                            @can('viewAny', App\Models\Product::class)
                                <li><a class="dropdown-item" href="{{ route('admin.products.index') }}">Kelola Produk</a></li>
                            @endcan
                            
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>