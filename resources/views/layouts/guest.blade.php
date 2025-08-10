<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        
        <style>
            .auth-container {
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: var(--bg-light-gray);
            }
            .auth-card {
                width: 100%;
                max-width: 450px;
                padding: 2.5rem;
                border: none;
                border-radius: 1rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                background-color: white;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-container">
            <div class="auth-card">
                <div class="text-center mb-4">
                     <a href="/">
                        <h1 style="color: var(--primary-maroon); font-weight: bold;">Desa Pasirlangu</h1>
                    </a>
                </div>
                {{ $slot }}
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>