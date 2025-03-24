<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
        $page = (object)[
            'title' => 'Daftar Barang Yang Tersedia'
        ];
        $activeMenu = 'barang';
        $barangs = Barang::all();
        return view('barang.index', compact('breadcrumb', 'page', 'activeMenu', 'barangs'));
    }

    public function list(Request $request)
    {
        $barangs = Barang::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_jual', 'harga_beli', 'created_at', 'updated_at');
        return DataTables::of($barangs)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn = '<a href="' . url('/barang/edit/' . $barang->barang_id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'barang_kode' => 'required|string|unique:barangs,barang_kode|max:10',
            'barang_nama' => 'required|string|max:100',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'kategori_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Barang::create($request->all());
        return redirect('/barang')->with('success', 'Barang berhasil disimpan');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('barang.edit', ['barang' => $barang]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'barang_kode' => 'required|string|unique:barangs,barang_kode,' . $id . ',barang_id|max:10',
            'barang_nama' => 'required|string|max:100',
            'harga_jual' => 'required|numeric',
            'harga_beli' => 'required|numeric',
            'kategori_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $barang = Barang::find($id);
        if ($barang) {
            $barang->update($request->all());
            return redirect('/barang')->with('success', 'Data berhasil diperbarui');
        }
        return redirect('/barang')->with('error', 'Data tidak ditemukan');
    }

    public function delete($id)
    {
        $barang = Barang::find($id);
        if ($barang) {
            try {
                $barang->delete();
                return redirect('/barang')->with('success', 'Data berhasil dihapus');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/barang')->with('error', 'Data tidak bisa dihapus');
            }
        }
        return redirect('/barang')->with('error', 'Data tidak ditemukan');
    }

    public function create_ajax()
    {
        return view('barang.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_kode' => 'required|string|unique:barangs,barang_kode|max:10',
                'barang_nama' => 'required|string|max:100',
                'harga_jual' => 'required|numeric',
                'harga_beli' => 'required|numeric',
                'kategori_id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            Barang::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Barang berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $barang = Barang::find($id);
        return view('barang.edit_ajax', ['barang' => $barang]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_kode' => 'required|string|unique:barangs,barang_kode,' . $id . ',barang_id|max:10',
                'barang_nama' => 'required|string|max:100',
                'harga_jual' => 'required|numeric',
                'harga_beli' => 'required|numeric',
                'kategori_id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $barang = Barang::find($id);
            if ($barang) {
                $barang->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diperbarui'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
