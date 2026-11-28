<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-[#031026] flex items-center">
            <span class="w-2 h-6 bg-yellow-400 mr-3 rounded-sm"></span>
            Daftar Akses Group Menu
        </h2>
        <!-- <a href="{{ route('menu.create') }}" class="inline-flex items-center px-4 py-2 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
            + Tambah Menu Baru
        </a> -->
        <a href="{{ route('groupmenu.create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Add New</span>
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
            <form method="GET" action="{{ route('groupmenu.index') }}" class="flex w-full sm:w-80">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode, nama, kategori, lokasi..."
                       class="w-full px-3.5 py-2 text-xs border border-slate-300 rounded-l-lg focus:outline-none focus:border-[#082454]">
                <button type="submit" class="px-4 py-2 bg-[#082454] text-blue-400 text-xs font-bold rounded-r-lg hover:bg-[#031026]">
                    Cari
                </button>
            </form>
            @if(request('search'))
                <a href="{{ route('groupmenu.index') }}" class="text-xs text-red-600 hover:underline">Reset Pencarian</a>
            @endif
        </div>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#031026] text-yellow-400 text-xs uppercase tracking-wider">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Group Menu Name</th>
                        <th class="py-3 px-4">Created Date</th>                        
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-sm">
                    @forelse ($groupmenus as $index => $item)
                        <tr class="hover:bg-blue-50/50 transition">
                            <td class="py-3 px-4 text-slate-500">{{ $groupmenus->firstItem() + $index }}</td>
                            <td class="py-3 px-4 font-medium text-slate-800">{{ $item->gm_name }}</td>
                            <td class="py-3 px-4 text-slate-600">
                                {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : 'h m s' }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex space-x-1.5">
                                    <!-- Tombol Detail (Read) -->
                                    <!-- <a href="{{ route('menu.show', $item->id) }}" class="px-2.5 py-1 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded">
                                        Detail
                                    </a> -->
                                    <a href="{{ route('groupmenu.show', $item->id) }}" title="Detail GroupMenu" 
                                            class="inline-flex items-center justify-center p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition">
                                            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                    </a>

                                    <!-- Tombol Edit (Update) -->
                                    <!-- <a href="{{ route('menu.edit', $item->id) }}" class="px-2.5 py-1 bg-yellow-400 hover:bg-amber-500 text-[#031026] text-xs font-bold rounded">
                                        Edit
                                    </a> -->
                                    <a href="{{ route('groupmenu.edit', $item->id) }}" title="Edit Group Menu" 
                                        class="inline-flex items-center justify-center p-2 text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-100 hover:text-amber-700 transition">
                                        <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <!-- Tombol Hapus (Delete) -->
                                    <form action="{{ route('groupmenu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus aset {{ $item->gm_name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Group Menu"
                                                class="inline-flex items-center justify-center p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 hover:text-red-700 transition">
                                            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
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
            {{ $groupmenus->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
