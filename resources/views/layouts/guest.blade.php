<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - Website Desa PasirLangu</title>

    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS untuk Desain Split-Screen -->
    <style>
        html, body {
            height: 100%;
        }
        .auth-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }
        .auth-image-section {
            background-color: #f0f0f0; /* Warna abu-abu */
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            font-size: 2rem;
            font-weight: bold;
        }
        .auth-form-section {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            padding: 2rem;
        }
        .auth-form-wrapper {
            width: 100%;
            max-width: 400px;
        }
        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
        }
        .form-control:focus {
            border-color: #888;
            box-shadow: none;
        }
        .btn-custom {
            background-color: #f0f0f0;
            border: none;
            padding: 0.75rem;
            font-weight: bold;
            width: 100%;
            border-radius: 0.5rem;
            color: #333;
        }
        .btn-custom:hover {
            background-color: #e0e0e0;
            color: #333;
        }
        .auth-title {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #333;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="auth-container">
        <!-- Kolom Kiri (Gambar) -->
        <div class="col-md-7 d-none d-md-flex auth-image-section">
            Foto Desa Pasirlangu
        </div>
        
        <!-- Kolom Kanan (Form) -->
        <div class="col-12 col-md-5 auth-form-section">
            <div class="auth-form-wrapper">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
