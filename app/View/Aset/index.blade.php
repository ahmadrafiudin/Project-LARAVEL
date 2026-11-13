<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-[#031026] flex items-center">
            <span class="w-2 h-6 bg-yellow-400 mr-3 rounded-sm"></span>
            Daftar Manajemen Aset
        </h2>
        <a href="{{ route('aset.create') }}" class="inline-flex items-center px-4 py-2 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
            + Tambah Aset Baru
        </a>
    </x-slot>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100 border-l-4 border-green-600 text-green-800 text-sm font-medium flex justify-between items-center">
            <span>✓ {{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-green-800 font-bold">&times;</button>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-[#082454] overflow-hidden">
        <!-- Bar Pencarian -->
        <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-3">
            <form method="GET" action="{{ route('aset.index') }}" class="flex w-full sm:w-80">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode, nama, kategori, lokasi..."
                       class="w-full px-3.5 py-2 text-xs border border-slate-300 rounded-l-lg focus:outline-none focus:border-[#082454]">
                <button type="submit" class="px-4 py-2 bg-[#082454] text-yellow-400 text-xs font-bold rounded-r-lg hover:bg-[#031026]">
                    Cari
                </button>
            </form>
            @if(request('search'))
                <a href="{{ route('aset.index') }}" class="text-xs text-red-600 hover:underline">Reset Pencarian</a>
            @endif
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#031026] text-yellow-400 text-xs uppercase tracking-wider">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Kode Aset</th>
                        <th class="py-3 px-4">Nama Aset</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Lokasi</th>
                        <th class="py-3 px-4">Kondisi</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm">
                    @forelse ($assets as $index => $item)
                        <tr class="hover:bg-blue-50/50 transition">
                            <td class="py-3 px-4 text-slate-500">{{ $assets->firstItem() + $index }}</td>
                            <td class="py-3 px-4 font-bold text-[#082454]">{{ $item->kode_aset }}</td>
                            <td class="py-3 px-4 font-medium text-slate-800">{{ $item->nama_aset }}</td>
                            <td class="py-3 px-4 text-slate-600">{{ $item->kategori }}</td>
                            <td class="py-3 px-4 text-slate-600">{{ $item->lokasi }}</td>
                            <td class="py-3 px-4">
                                @if($item->kondisi == 'Baik')
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">Baik</span>
                                @elseif($item->kondisi == 'Rusak Ringan')
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-yellow-100 text-amber-700">Rusak Ringan</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-red-100 text-red-700">Rusak Berat</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex space-x-1.5">
                                    <!-- Tombol Detail (Read) -->
                                    <a href="{{ route('aset.show', $item->id) }}" class="px-2.5 py-1 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded">
                                        Detail
                                    </a>
                                    <!-- Tombol Edit (Update) -->
                                    <a href="{{ route('aset.edit', $item->id) }}" class="px-2.5 py-1 bg-yellow-400 hover:bg-amber-500 text-[#031026] text-xs font-bold rounded">
                                        Edit
                                    </a>
                                    <!-- Tombol Hapus (Delete) -->
                                    <form action="{{ route('aset.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus aset {{ $item->nama_aset }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-500 text-sm">
                                Belum ada data aset yang tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-slate-100">
            {{ $assets->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
