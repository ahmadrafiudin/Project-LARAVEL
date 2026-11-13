<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIM ASET') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#eef3fb] text-slate-800">
    <div class="flex h-screen overflow-hidden">
        
        <!-- 1. SIDEBAR (TEMA DEEP NAVY TECH) -->
        @include('layouts.sidebar')

        <!-- AREA KANAN (HEADER + CONTENT + FOOTER) -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            
            <!-- 2. HEADER -->
            @include('layouts.header')

            <!-- 3. MAIN CONTENT (DINAMIS UNTUK SEMUA MODUL) -->
            <main class="flex-1 p-6">
                @if (isset($header))
                    <div class="mb-6 pb-3 border-b-2 border-[#082454]/10 flex items-center justify-between">
                        {{ $header }}
                    </div>
                @endif

                {{ $slot }}
            </main>

            <!-- 4. FOOTER -->
            @include('layouts.footer')
            
        </div>
    </div>

    <!-- Script Toggle Sidebar (Desktop & Mobile) dan Tree Menu -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('main-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (window.innerWidth >= 1024) {
                sidebar.classList.toggle('lg:hidden');
            } else {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }

        function toggleMenu(menuId, iconId) {
            const menu = document.getElementById(menuId);
            const icon = document.getElementById(iconId);
            
            if (menu) menu.classList.toggle('hidden');
            if (icon) icon.classList.toggle('-rotate-90');
        }
    </script>
</body>
</html>
