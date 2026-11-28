<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'kategori',
        'lokasi',
        'tanggal_beli',
        'harga',
        'kondisi',
        'keterangan',
        'created_by',
        'updated_by',
    ];
}
