<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIM ASET') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800 bg-gradient-to-br from-[#031026] via-[#07214f] to-[#031026] min-h-screen flex flex-col justify-center items-center p-4">
    
    <!-- Logo & Judul Sistem -->
    <div class="mb-6 text-center">
        <a href="/" class="inline-flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-yellow-400 flex items-center justify-center text-[#031026] text-2xl font-extrabold shadow-lg border-2 border-white/20">
                A
            </div>
            <div class="text-left">
                <span class="block text-2xl font-extrabold tracking-wider text-white">SIM<span class="text-yellow-400">ASET</span></span>
                <span class="block text-xs text-blue-200 uppercase tracking-widest">Sistem Manajemen Aset</span>
            </div>
        </a>
    </div>

    <!-- Kotak Form Utama -->
    <div class="w-full sm:max-w-md bg-white px-7 py-8 shadow-2xl rounded-2xl border-t-4 border-yellow-400">
        {{ $slot }}
    </div>

    <!-- Footer Kecil -->
    <div class="mt-6 text-xs text-blue-300/70">
        &copy; {{ date('Y') }} {{ config('app.name', 'SIM ASET') }}. All rights reserved.
    </div>
</body>
</html>
