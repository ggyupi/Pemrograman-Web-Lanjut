<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function penjualan(){
        return view('Penjualan.index')
        ->with('pesan', 'Ini adalah halaman transaksi POS');
    }
}
