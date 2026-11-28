<?php
namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller; // Wajib ditambahkan karena pindah sub-folder
use App\Models\GroupMenuHd;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupMenuController extends Controller
{
    public function index(Request $request)
    {
       $query = GroupMenuHd::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('gm_name', 'like', "%{$search}%");
        }

        $groupmenus = $query->orderBy('id', 'desc')
                            ->paginate(10)
                            ->withQueryString();

        return view("administration.groupmenu.index", compact("groupmenus"));
    }

    public function create()
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
                    ->select('id','menu_code','menu_name','level','parent_menu','created_at','sort_path')
                    ->selectRaw('0 as is_create, 0 as is_read, 0 as is_updated, 0 as is_delete');

        $menus = $query->orderBy('sort_path', 'asc')->paginate(100);

        return view('administration.groupmenu.create', compact('menus'));

    }

    public function store(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'gm_name'   => 'required|string',
            'details'   => 'required|array|min:1',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $userId = Auth::id() ?? 1; // Ambil ID user yang login

                // A. Simpan ke tabel Header (group_menu_hd)
                $header = GroupMenuHd::create([
                    'gm_name'        => $request->gm_name,
                    'is_active'      => $request->is_active ?? 1,
                    'created_by'     => $userId,
                ]);

                // B. Siapkan array untuk tabel Detail (group_menu_dt)
                $detailData = [];
                foreach ($request->details as $item) {
                    $detailData[] = [
                        'menu_id'    => $item['menu_id'],
                        'is_create'  => isset($item['is_create']) ? 1 : 0,
                        'is_read'    => isset($item['is_read']) ? 1 : 0,
                        'is_update' => isset($item['is_update']) ? 1 : 0,
                        'is_delete'  => isset($item['is_delete']) ? 1 : 0,
                        'created_by' => $userId,
                    ];
                }

                // C. Simpan semua detail sekaligus (otomatis mengisi gm_id)
                $header->details()->createMany($detailData);
            });

            return redirect()->route('groupmenu.index')->with('success', 'Data Group Menu berhasil disimpan!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
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


        // Ambil data header berdasarkan ID
        $groupmenu = GroupMenuHd::findOrFail($id);

        // Gunakan kembali variabel $cteSql milik Anda dari method create()
        $menus = Menu::from(DB::raw($cteSql))
                ->leftJoin('group_menu_dt as dt', function ($join) use ($id) {
                    $join->on('menu_hierarchy.id', '=', 'dt.menu_id')
                        ->where('dt.gm_id', '=', $id);
                        })
                ->select(
                    'menu_hierarchy.id',
                    'menu_hierarchy.menu_code',
                    'menu_hierarchy.menu_name',
                    'menu_hierarchy.level',
                    'menu_hierarchy.parent_menu',
                    'menu_hierarchy.created_at',
                    'menu_hierarchy.sort_path',
                    DB::raw('COALESCE(dt.is_create, 0) as is_create'),
                    DB::raw('COALESCE(dt.is_read, 0) as is_read'),
                    DB::raw('COALESCE(dt.is_update, 0) as is_update'),
                    DB::raw('COALESCE(dt.is_delete, 0) as is_delete')
                    )
                ->orderBy('menu_hierarchy.sort_path')
                ->get();

        return view('administration.groupmenu.edit', compact('groupmenu', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'gm_name'   => 'required|string',
            'details'   => 'required|array|min:1',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $userId = Auth::id() ?? 1;
                $header = GroupMenuHd::findOrFail($id);

                // A. Update data Header
                $header->update([
                    'gm_name'        => $request->gm_name,
                    'updated_by'     => $userId,
                ]);

                // B. Hapus detail lama, lalu masukkan ulang detail yang baru
                $header->details()->delete();

                $detailData = [];
                foreach ($request->details as $item) {
                    $detailData[] = [
                        'menu_id'    => $item['menu_id'],
                        'is_create'  => isset($item['is_create']) ? 1 : 0,
                        'is_read'    => isset($item['is_read']) ? 1 : 0,
                        'is_update' => isset($item['is_update']) ? 1 : 0,
                        'is_delete'  => isset($item['is_delete']) ? 1 : 0,
                        'created_by' => $userId,
                        'updated_by' => $userId,
                    ];
                }

                $header->details()->createMany($detailData);
            });

            return redirect()->route('groupmenu.index')->with('success', 'Data Group Menu berhasil diUpdate!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

}