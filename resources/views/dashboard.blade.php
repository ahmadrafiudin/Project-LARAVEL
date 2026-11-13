<x-app-layout>
    <!-- Banner Utama Tema Cyber-Tech -->
    <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-[#031026] via-[#092963] to-[#041533] p-6 sm:p-8 text-white shadow-lg border-b-4 border-yellow-400 mb-6">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <span class="inline-block px-3 py-1 mb-2 text-xs font-bold tracking-wider uppercase rounded-full bg-yellow-400 text-[#031026]">
                    Dashboard Utama
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Selamat Datang, <span class="text-yellow-400">{{ Auth::user()->name }}</span>!
                </h1>
                <p class="mt-1.5 text-sm text-blue-200 max-w-xl">
                    Kelola inventaris, pantau mutasi barang, dan cetak laporan aset secara terpusat dalam satu sistem.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="#" class="inline-flex items-center px-5 py-2.5 text-sm font-bold rounded-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-yellow-400 hover:to-amber-500 hover:text-[#031026] text-white shadow-md transition">
                    KELOLA ASET
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Kartu Statistik (Gaya Label Putih + Aksen Kuning-Biru) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-[#082454] hover:shadow-md transition">
            <div class="text-xs font-bold uppercase text-slate-400">Total Aset</div>
            <div class="mt-2 flex items-baseline justify-between">
                <span class="text-2xl font-extrabold text-[#031026]">128</span>
                <span class="px-2 py-0.5 text-xs font-semibold rounded bg-blue-100 text-[#082454]">Unit</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-yellow-400 hover:shadow-md transition">
            <div class="text-xs font-bold uppercase text-slate-400">Kondisi Baik</div>
            <div class="mt-2 flex items-baseline justify-between">
                <span class="text-2xl font-extrabold text-[#031026]">115</span>
                <span class="px-2 py-0.5 text-xs font-semibold rounded bg-yellow-100 text-amber-800">Aktif</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-sky-500 hover:shadow-md transition">
            <div class="text-xs font-bold uppercase text-slate-400">Sedang Dipinjam</div>
            <div class="mt-2 flex items-baseline justify-between">
                <span class="text-2xl font-extrabold text-[#031026]">9</span>
                <span class="px-2 py-0.5 text-xs font-semibold rounded bg-sky-100 text-sky-800">Mutasi</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-red-500 hover:shadow-md transition">
            <div class="text-xs font-bold uppercase text-slate-400">Perlu Perbaikan</div>
            <div class="mt-2 flex items-baseline justify-between">
                <span class="text-2xl font-extrabold text-[#031026]">4</span>
                <span class="px-2 py-0.5 text-xs font-semibold rounded bg-red-100 text-red-700">Rusak</span>
            </div>
        </div>
    </div>
</x-app-layout>
