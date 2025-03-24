<?php

// namespace App\Http\Controllers\views;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $breadcrumb = [
            'title' => 'Selamat Datang',
            'list' => ['Home','Welcome']
        ];
        $activeMenu = 'dashboard';
        return view('welcome', compact('breadcrumb','activeMenu'));
    }
}
