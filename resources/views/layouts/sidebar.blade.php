<!-- Overlay gelap untuk tampilan mobile -->
<div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 z-20 bg-black/60 hidden lg:hidden"></div>

<!-- Sidebar Utama -->
<aside id="main-sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-gradient-to-b from-[#041533] via-[#061e47] to-[#031026] text-blue-100 transform -translate-x-full transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col shrink-0 border-r border-blue-900/60 shadow-xl">
    
    <!-- Header Logo Aplikasi -->
    <div class="flex items-center justify-center h-14 px-4 bg-[#031026] border-b-2 border-yellow-400">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5">
            <div class="w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center text-[#031026] font-extrabold shadow">
                A
            </div>
            <div class="leading-tight">
                <span class="block text-base font-extrabold tracking-wider text-white">SIM<span class="text-yellow-400">ASET</span></span>
                <span class="block text-[10px] text-blue-300 uppercase tracking-widest">Sistem Terpadu</span>
            </div>
        </a>
    </div>

    <!-- Profil User di Sidebar -->
    <div class="flex flex-col items-center py-5 px-4 border-b border-blue-800/50 bg-[#051a3d]/50">
        <div class="w-20 h-20 rounded-full p-1 bg-gradient-to-tr from-yellow-400 to-blue-400 shadow-lg">
            <img src="https://ui-avatars.com{{ urlencode(Auth::user()->name) }}&background=031026&color=facc15&bold=true&size=128" alt="Avatar" class="w-full h-full object-cover rounded-full">
        </div>
        <span class="mt-2.5 text-sm font-bold text-white tracking-wide">{{ Auth::user()->name }}</span>
        <span class="mt-0.5 px-2.5 py-0.5 text-[11px] font-semibold rounded-full bg-blue-900/80 text-yellow-400 border border-yellow-400/30">
            Administrator
        </span>
    </div>

    <!-- Daftar Tree Menu -->
    <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto text-sm">
        
        <!-- Menu Tunggal: Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-3.5 py-2.5 rounded-lg font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-yellow-400 to-amber-500 text-[#031026] font-bold shadow-md' : 'text-blue-100 hover:bg-[#0d3270] hover:text-white' }}">
            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            BERANDA / DASHBOARD
        </a>

        <!-- TREE MENU 1: Administrasi Data -->
        <div>
            <button onclick="toggleMenu('menu-admin', 'icon-admin')" type="button" 
                    class="flex items-center justify-between w-full px-3.5 py-2.5 rounded-lg font-medium text-blue-100 hover:bg-[#0d3270] hover:text-white transition focus:outline-none">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    ADMINISTRASI DATA
                </span>
                <svg id="icon-master" class="w-3.5 h-3.5 text-yellow-400 transition-transform duration-200 {{ request()->is('admin*') ? '-rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <div id="menu-admin" class="{{ request()->is('admin*') ? '' : 'hidden' }} mt-1 ml-4 pl-3 border-l-2 border-yellow-400/50 space-y-1">
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Daftar User</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Daftar Menu</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Group Menu</a>
            </div>
        </div>

        <!-- TREE MENU 1: Master Data -->
        <div>
            <button onclick="toggleMenu('menu-master', 'icon-master')" type="button" 
                    class="flex items-center justify-between w-full px-3.5 py-2.5 rounded-lg font-medium text-blue-100 hover:bg-[#0d3270] hover:text-white transition focus:outline-none">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    MASTER DATA
                </span>
                <svg id="icon-master" class="w-3.5 h-3.5 text-yellow-400 transition-transform duration-200 {{ request()->is('master*') ? '-rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <div id="menu-master" class="{{ request()->is('master*') ? '' : 'hidden' }} mt-1 ml-4 pl-3 border-l-2 border-yellow-400/50 space-y-1">
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Kategori Aset</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Lokasi / Ruangan</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Data Supplier</a>
            </div>
        </div>

        <!-- TREE MENU 2: Transaksi Aset -->
        <div>
            <button onclick="toggleMenu('menu-aset', 'icon-aset')" type="button" 
                    class="flex items-center justify-between w-full px-3.5 py-2.5 rounded-lg font-medium text-blue-100 hover:bg-[#0d3270] hover:text-white transition focus:outline-none">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    TRANSAKSI ASET
                </span>
                <svg id="icon-aset" class="w-3.5 h-3.5 text-yellow-400 transition-transform duration-200 {{ request()->is('aset*') ? '-rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <div id="menu-aset" class="{{ request()->is('aset*') ? '' : 'hidden' }} mt-1 ml-4 pl-3 border-l-2 border-yellow-400/50 space-y-1">
                <a href="{{ route('aset.index') }}" 
                    class="block px-3 py-2 text-xs rounded transition {{ request()->routeIs('aset.*') ? 'bg-[#0d3270] text-yellow-400 font-bold' : 'text-blue-200 hover:bg-[#0d3270] hover:text-yellow-300' }}">
                    ▸ Daftar Semua Aset
                </a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Purchase Request</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Purchase Order</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Payment Request</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Receive Order</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Stock Asset</a>
            </div>
        </div>

<!-- TREE MENU 2: Approval Request -->
        <div>
            <button onclick="toggleMenu('menu-approval', 'icon-approval')" type="button" 
                    class="flex items-center justify-between w-full px-3.5 py-2.5 rounded-lg font-medium text-blue-100 hover:bg-[#0d3270] hover:text-white transition focus:outline-none">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    APPROVAL REQUEST
                </span>
                <svg id="icon-aset" class="w-3.5 h-3.5 text-yellow-400 transition-transform duration-200 {{ request()->is('aset*') ? '-rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <div id="menu-approval" class="{{ request()->is('approval*') ? '' : 'hidden' }} mt-1 ml-4 pl-3 border-l-2 border-yellow-400/50 space-y-1">
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Approval Purchase Request</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Approval Purchase Order</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Approval Payment Request</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Approval Receive Order</a>
            </div>
        </div>

        <!-- TREE MENU 3: Laporan -->
        <div>
            <button onclick="toggleMenu('menu-report', 'icon-report')" type="button" 
                    class="flex items-center justify-between w-full px-3.5 py-2.5 rounded-lg font-medium text-blue-100 hover:bg-[#0d3270] hover:text-white transition focus:outline-none">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    LAPORAN
                </span>
                <svg id="icon-report" class="w-3.5 h-3.5 text-yellow-400 transition-transform duration-200 {{ request()->is('report*') ? '-rotate-90' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <div id="menu-report" class="{{ request()->is('report*') ? '' : 'hidden' }} mt-1 ml-4 pl-3 border-l-2 border-yellow-400/50 space-y-1">
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Report Asset</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Report Purchase Request</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Report Purchase Order</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Report Payment Request</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Report Receive Order</a>
                <a href="#" class="block px-3 py-2 text-xs text-blue-200 rounded hover:bg-[#0d3270] hover:text-yellow-300 transition">▸ Report StockAsset</a> 
            </div>
        </div>

    </nav>
</aside>
