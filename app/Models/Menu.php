<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';

    protected $fillable = [
            'menu_code', 
            'menu_name', 
            'level',
            'parent_menu_id', 
            'route', 
            'action', 
            'is_active',
            'created_by',
    ];
}