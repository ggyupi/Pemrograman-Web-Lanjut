<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\BarangDataTable;
use App\Models\BarangModel;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(BarangDataTable $dataTable)
    {
        return $dataTable->render('barang.index');
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
        ]);

        return redirect('/barang');
    }
    public function edit($id)
    {
        $barang = BarangModel::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|string|max:100',
            'harga_jual' => 'required|integer',
            'harga_beli' => 'required|integer',
        ]);

        $barang = BarangModel::findOrFail($id);
        $barang->update([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_jual' => $request->harga_jual,
            'harga_beli' => $request->harga_beli,
        ]);

        return redirect()->route('barang.index')->with('status', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        $barang = BarangModel::findOrFail($id); // Find the barang by ID or throw a 404 error
        $barang->delete(); // Delete the barang

        return redirect()->route('barang.index')->with('status', 'Data berhasil dihapus');
    }
}
