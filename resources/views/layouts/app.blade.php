<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-g">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        
        @stack('styles')
    </head>
    <body class="d-flex flex-column min-vh-100 bg-light">
        <div id="app" class="flex-grow-1">
            @include('layouts.navigation-custom')

            @if (isset($header))
                <header class="bg-white shadow-sm">
                    <div class="container py-3">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="container py-4">
                {{-- INI BAGIAN PENTING YANG DIPERBAIKI --}}
                @if (isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
        
        @include('layouts.footer-custom')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>
</html>