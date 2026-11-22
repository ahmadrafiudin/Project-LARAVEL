<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-[#031026] flex items-center">
            <span class="w-2 h-6 bg-yellow-400 mr-3 rounded-sm"></span>
            Edit Data Aset: {{ $aset->kode_aset }}
        </h2>
        <a href="{{ route('aset.index') }}" class="text-xs font-bold text-[#082454] hover:underline">
            ← Kembali ke Daftar
        </a>
    </x-slot>

    <div class="max-w-3xl bg-white p-6 rounded-xl shadow-sm border-t-4 border-[#082454]">
        <form action="{{ route('aset.update', $aset->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kode Aset *</label>
                    <input type="text" name="kode_aset" value="{{ old('kode_aset', $aset->kode_aset) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('kode_aset') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Nama Aset *</label>
                    <input type="text" name="nama_aset" value="{{ old('nama_aset', $aset->nama_aset) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                    @error('nama_aset') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kategori *</label>
                    <select name="kategori" required class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454]">
                        <option value="Elektronik & IT" {{ old('kategori', $aset->kategori) == 'Elektronik & IT' ? 'selected' : '' }}>Elektronik & IT</option>
                        <option value="Furnitur Kantor" {{ old('kategori', $aset->kategori) == 'Furnitur Kantor' ? 'selected' : '' }}>Furnitur Kantor</option>
                        <option value="Kendaraan" {{ old('kategori', $aset->kategori) == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                        <option value="Mesin & Peralatan" {{ old('kategori', $aset->kategori) == 'Mesin & Peralatan' ? 'selected' : '' }}>Mesin & Peralatan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Lokasi / Ruangan *</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi', $aset->lokasi) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Tanggal Perolehan *</label>
                    <input type="date" name="tanggal_beli" value="{{ old('tanggal_beli', $aset->tanggal_beli) }}" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Harga Perolehan (Rp) *</label>
                    <input type="number" name="harga" value="{{ old('harga', $aset->harga) }}" min="0" required
                           class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Kondisi Aset *</label>
                <select name="kondisi" required class="w-full sm:w-1/2 px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454]">
                    <option value="Baik" {{ old('kondisi', $aset->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak Ringan" {{ old('kondisi', $aset->kondisi) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="Rusak Berat" {{ old('kondisi', $aset->kondisi) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Keterangan / Spesifikasi</label>
                <textarea name="keterangan" rows="3"
                          class="w-full px-3.5 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:border-[#082454] focus:ring-2 focus:ring-yellow-400/50">{{ old('keterangan', $aset->keterangan) }}</textarea>
            </div>

            <div class="pt-3 flex items-center space-x-3 border-t border-slate-100">
                <button type="submit" class="px-6 py-2.5 bg-yellow-400 hover:bg-amber-500 text-[#031026] text-xs font-bold uppercase tracking-wider rounded-lg shadow transition">
                    Update Data Aset
                </button>
                <a href="{{ route('aset.index') }}" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold uppercase rounded-lg">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
