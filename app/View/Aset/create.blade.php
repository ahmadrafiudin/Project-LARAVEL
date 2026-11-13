<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-[#031026] flex items-center">
            <span class="w-2 h-6 bg-yellow-400 mr-3 rounded-sm"></span>
            Tambah Data Aset Baru
        </h2>
        <a href="{{ route('aset.index') }}" class="text-xs font-bold text-[#082454] hover:underline">
            ← Kembali ke Daftar
        </a>
    </x-slot>

    <div class="max-w-3xl bg-white p-6 rounded-xl shadow-sm border-t-4 border-yellow-400">
        <form action="{{ route('aset.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kode Aset *</label>
                    <input type="text" name="kode_aset" value="{{ old('kode_aset') }}" placeholder="Contoh: AST-2026-001" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('kode_aset') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama Aset *</label>
                    <input type="text" name="nama_aset" value="{{ old('nama_aset') }}" placeholder="Contoh: Laptop Asus ROG" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('nama_aset') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kategori *</label>
                    <select name="kategori" required class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454]">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Elektronik & IT" {{ old('kategori') == 'Elektronik & IT' ? 'selected' : '' }}>Elektronik & IT</option>
                        <option value="Furnitur Kantor" {{ old('kategori') == 'Furnitur Kantor' ? 'selected' : '' }}>Furnitur Kantor</option>
                        <option value="Kendaraan" {{ old('kategori') == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                        <option value="Mesin & Peralatan" {{ old('kategori') == 'Mesin & Peralatan' ? 'selected' : '' }}>Mesin & Peralatan</option>
                    </select>
                    @error('kategori') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Lokasi / Ruangan *</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="Contoh: Ruang Server Lt. 2" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('lokasi') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Tanggal Perolehan *</label>
                    <input type="date" name="tanggal_beli" value="{{ old('tanggal_beli') }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('tanggal_beli') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Harga Perolehan (Rp) *</label>
                    <input type="number" name="harga" value="{{ old('harga', 0) }}" min="0" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('harga') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kondisi Aset *</label>
                <select name="kondisi" required class="w-full sm:w-1/2 px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454]">
                    <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Keterangan / Spesifikasi</label>
                <textarea name="keterangan" rows="3" placeholder="Catatan tambahan mengenai kondisi atau spesifikasi aset..."
                          class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">{{ old('keterangan') }}</textarea>
            </div>

            <div class="pt-3 flex items-center space-x-3 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 bg-[#031026] hover:bg-[#0a2963] text-yellow-400 text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
                    Simpan Data Aset
                </button>
                <a href="{{ route('aset.index') }}" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold uppercase rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
