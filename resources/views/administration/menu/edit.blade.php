<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-[#031026] flex items-center">
            <span class="w-2 h-6 bg-yellow-400 mr-3 rounded-sm"></span>
            Edit Data Menu: {{ $menu->menu_code }}
        </h2>
        <a href="{{ route('menu.index') }}" class="text-xs font-bold text-[#082454] hover:underline">
            ← Kembali ke Daftar
        </a>
    </x-slot>

    <div class="max-w-3xl bg-white p-6 rounded-xl shadow-sm border-t-4 border-yellow-400">
        <form action="{{ route('menu.update',$menu->id) }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kode Menu</label>
                    <input type="text" name="menu_code" value="{{ old('menu_code', $menu->menu_code) }}" placeholder="Contoh: MN000001" disabled
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('menu_code') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama Menu *</label>
                    <input type="text" name="menu_name" value="{{ old('menu_name',$menu->menu_name) }}" placeholder="Contoh: Laptop Asus ROG" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('menu_name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Parent Menu *</label>
                    <select name="parent_menu_id" class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454]">
                        <option value="">-- Tidak Ada (Menu Utama) --</option>
                        @foreach($parentMenus as $id => $menuName)
                            <option value="{{ $id }}" {{ old('parent_menu_id', $menu->parent_menu_id ?? '') == $id ? 'selected' : '' }}>
                                {{ $menuName }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_menu_id') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Level *</label>
                    <input type="text" name="level" value="{{ old('level',$menu->level) }}" placeholder="Contoh: Level 1" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('level') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>        
            
            </div>

            <div class="pt-3 flex items-center space-x-3 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
                    Simpan Data Menu
                </button>
                <a href="{{ route('menu.index') }}" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold uppercase rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
