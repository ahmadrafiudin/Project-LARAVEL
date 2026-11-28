<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMenuDt extends Model
{
    use HasFactory;
    protected $table = 'group_menu_dt';

    protected $fillable = [
            'gm_id', 
            'menu_id',
            'is_create',
            'is_read',
            'is_update',
            'is_delete',
            'created_by',
            'updated_by',
    ];

    // Relasi balik ke tabel header
    public function header()
    {
        return $this->belongsTo(GroupMenuHd::class, 'gm_id', 'id');
    }
}