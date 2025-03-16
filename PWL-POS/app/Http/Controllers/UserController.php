<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\database\Eloquent\ModelNotFoundException;
use App\DataTables\UserDataTable;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        UserModel::create([
            'level_id' => $request->level_id,
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            
        ]);

        return redirect('/user');
    }
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'level_id' => 'required|integer',
            'username' => 'required|string|max:100',
            'nama' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
            
        ]);

        $user = UserModel::findOrFail($id);
        $user->update([
            'level_id' => $request->level_id,
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            
        ]);

        return redirect()->route('user.index')->with('status', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        $user = UserModel::findOrFail($id); // Find the user by ID or throw a 404 error
        $user->delete(); // Delete the user

        return redirect()->route('user.index')->with('status', 'Data berhasil dihapus');
    }
}