<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMenuHd extends Model
{
    use HasFactory;
    protected $table = 'group_menu_hd';

    protected $fillable = [
            'gm_name', 
            'is_active',
            'created_by',
            'updated_by',
    ];

    // Relasi One-to-Many ke tabel detail
    public function details()
    {
        return $this->hasMany(GroupMenuDt::class, 'gm_id', 'id');
    }
}