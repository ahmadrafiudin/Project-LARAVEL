<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-[#031026] flex items-center">
            <span class="w-2 h-6 bg-yellow-400 mr-3 rounded-sm"></span>
            Detail Informasi Aset
        </h2>
        <a href="{{ route('aset.index') }}" class="text-xs font-bold text-[#082454] hover:underline">
            ← Kembali ke Daftar
        </a>
    </x-slot>

    <div class="max-w-3xl bg-white rounded-xl shadow-sm border-t-4 border-[#082454] overflow-hidden">
        <div class="bg-[#031026] px-6 py-4 flex justify-between items-center text-white">
            <div>
                <span class="text-xs text-yellow-400 font-bold uppercase tracking-wider">{{ $aset->kode_aset }}</span>
                <h3 class="text-lg font-extrabold">{{ $aset->nama_aset }}</h3>
            </div>
            <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-400 text-[#031026]">
                {{ $aset->kondisi }}
            </span>
        </div>

        <div class="p-6 divide-y divide-slate-100 text-sm">
            <div class="py-3 grid grid-cols-3">
                <span class="font-bold text-slate-500">Kategori Aset</span>
                <span class="col-span-2 text-slate-800 font-medium">{{ $aset->kategori }}</span>
            </div>
            <div class="py-3 grid grid-cols-3">
                <span class="font-bold text-slate-500">Lokasi Penempatan</span>
                <span class="col-span-2 text-slate-800 font-medium">{{ $aset->lokasi }}</span>
            </div>
            <div class="py-3 grid grid-cols-3">
                <span class="font-bold text-slate-500">Tanggal Perolehan</span>
                <span class="col-span-2 text-slate-800 font-medium">{{ \Carbon\Carbon::parse($aset->tanggal_beli)->format('d F Y') }}</span>
            </div>
            <div class="py-3 grid grid-cols-3">
                <span class="font-bold text-slate-500">Nilai / Harga Beli</span>
                <span class="col-span-2 text-[#082454] font-extrabold">Rp {{ number_format($aset->harga, 0, ',', '.') }}</span>
            </div>
            <div class="py-3 grid grid-cols-3">
                <span class="font-bold text-slate-500">Keterangan</span>
                <span class="col-span-2 text-slate-700">{{ $aset->keterangan ?? '-' }}</span>
            </div>
        </div>

        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end space-x-3">
            <a href="{{ route('aset.edit', $aset->id) }}" class="px-5 py-2 bg-yellow-400 hover:bg-amber-500 text-[#031026] text-xs font-bold uppercase rounded-lg shadow">
                Edit Data Ini
            </a>
        </div>
    </div>
</x-app-layout>
