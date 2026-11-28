<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-[#031026] flex items-center">
            <span class="w-2 h-6 bg-yellow-400 mr-3 rounded-sm"></span>
            Tambah Data Group Menu Baru
        </h2>
        <a href="{{ route('groupmenu.index') }}" class="text-xs font-bold text-[#082454] hover:underline">
            ← Kembali ke Daftar
        </a>
    </x-slot>

    <div class="max-w-3xl bg-white p-6 rounded-xl shadow-sm border-t-4 border-yellow-400">
        <form action="{{ route('groupmenu.store') }}" method="POST" class="space-y-4">
            @csrf
            {{-- Tampilkan semua error validasi atau pesan catch dari Controller --}}
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-300">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-300">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama Group Menu *</label>
                    <input type="text" name="gm_name" value="{{ old('menu_name') }}" placeholder="Contoh: Administrator" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('gm_name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>            
            </div>
            <div class="grid grid-cols-1">
                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">List Access Menu</label>
                <table class="w-full text-left border-collapse" id="menu-permission-table">
                    <thead>
                        <tr class="bg-[#031026] text-yellow-400 text-xs uppercase tracking-wider">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4 text-center">All</th>
                            <th class="py-3 px-4">Menu Code</th>
                            <th class="py-3 px-4">Menu Name</th>
                            <th class="py-3 px-4">Create</th>                        
                            <th class="py-3 px-4">Read</th>
                            <th class="py-3 px-4">Update</th>                        
                            <th class="py-3 px-4">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-sm">
                        @forelse ($menus as $index => $item)
                            <tr class="hover:bg-blue-50/50 transition menu-row"
                                data-menu-id="{{ strtolower(trim($item->menu_name)) }}" 
                                data-parent-id="{{ strtolower(trim($item->parent_menu ?? '')) }}">

                                <td class="py-3 px-4 text-slate-500">
                                    {{-- $menus->firstItem() + $index --}}
                                    {{ $loop->iteration }}
                                    <input type="hidden" name="details[{{ $index }}][menu_id]" value="{{ $item->id }}">
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <input type="checkbox" 
                                        class="row-check-all w-4 h-4 text-amber-500 rounded border-slate-300 focus:ring-amber-500 cursor-pointer"
                                        title="Pilih semua akses untuk menu ini dan sub-menunya">
                                </td>
                                <td class="py-3 px-4 font-medium text-slate-800">{{ $item->menu_code }}</td>
                                <td class="py-3 px-4 font-medium text-slate-800">{{ $item->menu_name }}</td>
                                <td class="py-3 px-4 text-center">
                                    <input type="checkbox" 
                                        name="details[{{ $index }}][is_create]" 
                                        value="1" 
                                        {{ $item->is_create ? 'checked' : '' }}
                                        class="perm-checkbox w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500 cursor-pointer">
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <input type="checkbox" 
                                        name="details[{{ $index }}][is_read]" 
                                        value="1" 
                                        {{ $item->is_read ? 'checked' : '' }}
                                        class="perm-checkbox w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500 cursor-pointer">
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <input type="checkbox" 
                                        name="details[{{ $index }}][is_update]" 
                                        value="1" 
                                        {{ $item->is_update ? 'checked' : '' }}
                                        class="perm-checkbox w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500 cursor-pointer">
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <input type="checkbox" 
                                        name="details[{{ $index }}][is_delete]" 
                                        value="1" 
                                        {{ $item->is_delete ? 'checked' : '' }}
                                        class="perm-checkbox w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500 cursor-pointer">
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

            <div class="pt-3 flex items-center space-x-3 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
                    Simpan Data Menu
                </button>
                <a href="{{ route('groupmenu.index') }}" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold uppercase rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.getElementById('menu-permission-table');
            if (!table) return;

            // 1. Fungsi rekursif untuk kolom ALL (mencentang baris ini + semua child-nya)
            function toggleRowAndChildren(menuId, isChecked) {
                if (!menuId) return;

                table.querySelectorAll(`tr.menu-row[data-menu-id="${menuId}"]`).forEach(row => {
                    const masterCheckbox = row.querySelector('.row-check-all');
                    if (masterCheckbox) masterCheckbox.checked = isChecked;

                    row.querySelectorAll('.perm-checkbox').forEach(cb => {
                        cb.checked = isChecked;
                    });
                });

                table.querySelectorAll(`tr.menu-row[data-parent-id="${menuId}"]`).forEach(childRow => {
                    const childId = childRow.getAttribute('data-menu-id');
                    toggleRowAndChildren(childId, isChecked);
                });
            }

            // 2. Fungsi rekursif khusus kolom CRUD tertentu (is_create / is_read / is_updated / is_delete)
            function toggleSinglePermAndChildren(menuId, permKey, isChecked) {
                if (!menuId) return;

                table.querySelectorAll(`tr.menu-row[data-menu-id="${menuId}"]`).forEach(row => {
                    // Centang checkbox sesuai jenis izin yang diklik (misal: [is_create])
                    const targetCb = row.querySelector(`input.perm-checkbox[name*="[${permKey}]"]`);
                    if (targetCb) targetCb.checked = isChecked;

                    // Sinkronisasi checkbox ALL di baris ini
                    updateMasterCheckbox(row);
                });

                // Teruskan ke semua menu anak di bawahnya secara rekursif
                table.querySelectorAll(`tr.menu-row[data-parent-id="${menuId}"]`).forEach(childRow => {
                    const childId = childRow.getAttribute('data-menu-id');
                    toggleSinglePermAndChildren(childId, permKey, isChecked);
                });
            }

            // Helper untuk mengecek apakah keempat CRUD di baris tersebut sudah tercentang semua
            function updateMasterCheckbox(row) {
                const masterCheckbox = row.querySelector('.row-check-all');
                const allPerms = row.querySelectorAll('.perm-checkbox');
                if (masterCheckbox && allPerms.length > 0) {
                    masterCheckbox.checked = Array.from(allPerms).every(cb => cb.checked);
                }
            }

            // Event listener utama
            table.addEventListener('change', function (e) {
                const row = e.target.closest('tr.menu-row');
                if (!row) return;
                const menuId = row.getAttribute('data-menu-id');

                // A. Jika kolom ALL yang diklik
                if (e.target.classList.contains('row-check-all')) {
                    toggleRowAndChildren(menuId, e.target.checked);
                }

                // B. Jika salah satu kolom Create / Read / Update / Delete yang diklik
                if (e.target.classList.contains('perm-checkbox')) {
                    // Ambil nama izin dari atribut name, misal: details[0][is_create] -> is_create
                    const match = e.target.name.match(/\[(is_\w+)\]/);
                    if (match && match[1]) {
                        const permKey = match;
                        toggleSinglePermAndChildren(menuId, permKey, e.target.checked);
                    }
                }
            });
        });
    </script>

</x-app-layout>
