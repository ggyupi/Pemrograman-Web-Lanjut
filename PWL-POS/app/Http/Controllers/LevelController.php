<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LevelModel;
use App\Models\Level;
use App\DataTables\LevelDataTable;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable)
    {
        return $dataTable->render('level.index');
    }

    public function create()
    {
        return view('level.create');
    }

    public function store(Request $request)
    {
        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level');
    }
    public function edit($id)
    {
        $level = LevelModel::findOrFail($id);
        return view('level.edit', compact('level'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:levels,level_kode,' . $id . ',id',
            'level_nama' => 'required|string|max:100',
        ]);

        $level = LevelModel::findOrFail($id);
        $level->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect()->route('level.index')->with('status', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        $level = LevelModel::findOrFail($id); // Find the level by ID or throw a 404 error
        $level->delete(); // Delete the level

        return redirect()->route('level.index')->with('status', 'Data berhasil dihapus');
    }
}
