<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Lambda - Perjalanan Dinas') }}</title>
    
    <!-- Memanggil CSS bawaan dari referensi Alpha[cite: 1] -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="app-wrapper">
        <!-- Include Header -->
        @include('components.header')

        <div class="main-content-wrapper">
            <!-- Include Sidebar -->
            <x-sidebar />

            <!-- Konten Dinamis -->
            <main class="content-area">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>