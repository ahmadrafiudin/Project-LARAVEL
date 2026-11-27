<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller; // Wajib ditambahkan karena pindah sub-folder
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class MenuController extends Controller
{
    public function index(Request $request)
    {
        $cteSql = "(
            WITH RECURSIVE menu_tree AS (
                SELECT 
                    id, 
                    menu_code, 
                    menu_name, 
                    `level`, 
                    parent_menu_id,
                    created_at,
                    CAST(LPAD(id, 5, '0') AS CHAR(255)) AS sort_path
                FROM menu
                WHERE parent_menu_id = 1 AND is_active = 1

                UNION ALL

                SELECT 
                    m.id, 
                    m.menu_code, 
                    m.menu_name, 
                    m.`level`, 
                    m.parent_menu_id,
                    m.created_at,
                    CONCAT(mt.sort_path, '-', LPAD(m.id, 5, '0')) AS sort_path
                FROM menu m
                INNER JOIN menu_tree mt ON m.parent_menu_id = mt.id
                WHERE m.is_active = 1
            )
            SELECT 
                mt.id,
                mt.menu_code,
                mt.menu_name,
                mt.`level`,
                m2.menu_name AS parent_menu,
                mt.created_at,
                mt.sort_path
            FROM menu_tree mt
            LEFT JOIN menu m2 ON m2.id = mt.parent_menu_id
        ) as menu_hierarchy";

        $query = Menu::from(DB::raw($cteSql))
                    ->select(
                        'id',
                        'menu_code',
                        'menu_name',
                        'level',
                        'parent_menu',
                        'created_at',
                        'sort_path'
                    );

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('menu_code', 'like', "%{$search}%")
                ->orWhere('menu_name', 'like', "%{$search}%")
                ->orWhere('parent_menu', 'like', "%{$search}%")
                ->orWhere('level', 'like', "%{$search}%");
            });
        }

        $menus = $query->orderBy('sort_path', 'asc')->paginate(10);

        return view('administration.menu.index', compact('menus'));
    }

    public function create()
    {
        $parentMenus = Menu::where('is_active', 1)
                        ->where('parent_menu_id',1)
                        ->orderBy('id', 'asc')
                        ->pluck('menu_name', 'id');

        return view('administration.menu.create', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        //  dd($request->all()); 

        $validated = $request->validate([
            // 'menu_code'      => 'nullable|string|max:50|unique:menu,menu_code',
            'menu_name'      => 'required|string|max:100',
            'level'          => 'required|integer',
            'parent_menu_id' => 'nullable|exists:menu,id',
            'route'          => 'nullable|string|max:100',
            'action'         => 'nullable|string|max:100',
        ]);

        $tableStatus = DB::select("SHOW TABLE STATUS LIKE 'menu'");
        $nextId      = $tableStatus[0]->Auto_increment ?? 1;

        $sequence = str_pad($nextId, 6, '0', STR_PAD_LEFT); // Menghasilkan "000001"

        $validated['menu_code'] = 'MN' . $sequence;
        $validated['is_active'] = $request->input('is_active', 1);
        $validated['created_by'] = Auth::id(); 

        Menu::create($validated);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        // Kecualikan menu itu sendiri dari pilihan parent agar tidak loop
        $parentMenus = Menu::where('id', '!=', $menu->id)
                            ->where('is_active', 1)
                            ->where('parent_menu_id',1)
                            ->orderBy('id', 'asc')
                            ->pluck('menu_name', 'id');

                            
        return view('administration.menu.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'menu_code'      => 'required|string|max:50|unique:menu,menu_code,' . $menu->id,
            'menu_name'      => 'required|string|max:100',
            'level'          => 'required|integer',
            'parent_menu_id' => 'nullable|exists:menu,id',
            'route'          => 'nullable|string|max:100',
            'action'         => 'nullable|string|max:100',
            'is_active'      => 'required|boolean',
        ]);

        $menu->update($validated);

        return redirect()->route('administration.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('administration.menu.index')->with('success', 'Menu berhasil dihapus.');
    }

    public function show(Menu $menu)
    {
        return redirect()->route('administration.menu.edit', $menu->id);
    }
}