<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Website Desa PasirLangu')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
{{-- Body diubah untuk mendukung sticky footer --}}
<body class="d-flex flex-column min-vh-100 bg-light">
    {{-- Wrapper utama diubah menjadi flex-grow-1 --}}
    <div class="flex-grow-1">
        @include('layouts.navigation-custom')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm">
                <div class="container py-3">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="container py-4">
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>
    </div>


    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} Desa PasirLangu Digital. All Rights Reserved.
            </p>
            <p class="mb-0">
               Biro Dedikasi Masyarakat HMSI Telkom University
            </p>
            <p class="mb-0 small">
                Powered by: <span class="fw-bold">LangWasHere</span>
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
