<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function index()
    {

        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_dua',
        //     'nama' => 'Manager 2',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::where('username', 'customer-1')->update($data);
        // $data = UserModel::all(); //mengambil semua data dari tabel m_user
        // return view('user', ['data' => $data]); 

        //JS 4- praktikum 1
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);
        // $user = UserModel::all(); 
        // return view('user', ['data' => $user]);
        
        //JS 4- praktikum 2.1 – Retrieving Single Models
        // $user = UserModel::firstWhere('level_id', 1);
        // $user = UserModel::findOrFail(20, ['username', 'nama'], function () {
        //     abort(404);
        // });
        // return view('user', ['data' => $user]);

        //JS 4- praktikum 2.2 - Not Found Exceptions
        $user = UserModel::where('username', 'manager9')->firstOrFail();
        return view('user', ['data' => $user]);
    }
}