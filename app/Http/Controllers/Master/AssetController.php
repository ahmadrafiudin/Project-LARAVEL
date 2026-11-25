<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller; // Wajib ditambahkan karena pindah sub-folder
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $query = Asset::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_aset', 'like', "%{$search}%")
                  ->orWhere('nama_aset', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
        }

        $assets = $query->latest()->paginate(10);
        return view('master.aset.index', compact('assets'));
    }

    public function create()
    {
        $kategoris = [
            'Elektronik & IT',
            'Furnitur Kantor',
            'Kendaraan',
            'Mesin & Peralatan',
        ];

        $kondisis = [
            'Baik',
            'Rusak Ringan',
            'Rusak Berat',
            'Butuh Perbaikan'
        ];

        return view('master.aset.create', compact('kategoris','kondisis'));
    }

    public function store(Request $request)
    {
        if ($request->filled('harga')) {
            $request->merge([
                'harga' => str_replace(',', '', $request->harga),
            ]);
        }

        $validated = $request->validate([
            'kode_aset'    => 'required|string|max:50|unique:assets,kode_aset',
            'nama_aset'    => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'lokasi'       => 'required|string|max:100',
            'tanggal_beli' => 'required|date',
            'harga'        => 'required|numeric|min:0',
            'kondisi'      => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'keterangan'   => 'nullable|string',
        ]);

        $tableStatus = DB::select("SHOW TABLE STATUS LIKE 'assets'");
        $nextId      = $tableStatus[0]->Auto_increment ?? 1;

        $prefix   = date('ym') . '/AST/'; // Menghasilkan "2611/AST/"
        $sequence = str_pad($nextId, 6, '0', STR_PAD_LEFT); // Menghasilkan "000001"

        $validated['kode_aset'] = $prefix . $sequence;

        Asset::create($validated);

        return redirect()->route('master.aset.index')->with('success', 'Data aset baru berhasil ditambahkan!');
    }

    public function show(Asset $aset)
    {
        return view('master.aset.show', compact('aset'));
    }

    public function edit(Asset $aset)
    {
        return view('master.aset.edit', compact('aset'));
    }

    public function update(Request $request, Asset $aset)
    {
        $validated = $request->validate([
            'kode_aset'    => 'required|string|max:50|unique:assets,kode_aset,' . $aset->id,
            'nama_aset'    => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'lokasi'       => 'required|string|max:100',
            'tanggal_beli' => 'required|date',
            'harga'        => 'required|numeric|min:0',
            'kondisi'      => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'keterangan'   => 'nullable|string',
        ]);

        $aset->update($validated);

        return redirect()->route('master.aset.index')->with('success', 'Data aset berhasil diperbarui!');
    }

    public function destroy(Asset $aset)
    {
        $aset->delete();

        return redirect()->route('master.aset.index')->with('success', 'Data aset berhasil dihapus!');
    }
}
