<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('Home.index')
        ->with('pesan','Ini adalah halaman awal website');
    }
}
