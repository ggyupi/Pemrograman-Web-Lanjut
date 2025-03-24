<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];
        $page = (object)[
            'title' => 'Daftar Supplier Yang Tersedia'
        ];
        $activeMenu = 'supplier';
        $suppliers = Supplier::all();
        return view('supplier.index', compact('breadcrumb', 'page', 'activeMenu', 'suppliers'));
    }

    public function list(Request $request)
    {
        $suppliers = Supplier::select('supplier_id', 'supplier_kode', 'supplier_nama', 'created_at', 'updated_at');
        return DataTables::of($suppliers)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                $btn = '<a href="' . url('/supplier/edit/' . $supplier->supplier_id) . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'supplier_kode' => 'required|string|unique:suppliers,supplier_kode|max:10',
           
            'name_supplier' => 'required|string|max:100',
            'supplier_contact' => 'required|string|max:20',
            'supplier_alamat' => 'required|string|max:255',
            'supplier_email' => 'required|string|max:100',
            'supplier_aktif' => 'required|boolean',
            'supplier_keterangan' => 'nullable|string|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Supplier::create($request->all());
        return redirect('/supplier')->with('success', 'Supplier berhasil disimpan');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('supplier.edit', ['supplier' => $supplier]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'supplier_kode' => 'required|string|unique:suppliers,supplier_kode,' . $id . ',supplier_id|max:10',
            'name_supplier' => 'required|string|max:100',
            'supplier_contact' => 'required|string|max:20',
            'supplier_alamat' => 'required|string|max:255',
            'supplier_email' => 'required|string|max:100',
            'supplier_aktif' => 'required|boolean',
            'supplier_keterangan' => 'nullable|string|max:255'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->update($request->all());
            return redirect('/supplier')->with('success', 'Data berhasil diperbarui');
        }
        return redirect('/supplier')->with('error', 'Data tidak ditemukan');
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            try {
                $supplier->delete();
                return redirect('/supplier')->with('success', 'Data berhasil dihapus');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect('/supplier')->with('error', 'Data tidak bisa dihapus');
            }
        }
        return redirect('/supplier')->with('error', 'Data tidak ditemukan');
    }

    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|unique:suppliers,supplier_kode|max:10',
                'supplier_nama' => 'required|string|max:100',
                'name_supplier' => 'required|string|max:100',
            'supplier_contact' => 'required|string|max:20',
            'supplier_alamat' => 'required|string|max:255',
            'supplier_email' => 'required|string|max:100',
            'supplier_aktif' => 'required|boolean',
            'supplier_keterangan' => 'nullable|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            Supplier::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Supplier berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $supplier = Supplier::find($id);
        return view('supplier.edit_ajax', ['supplier' => $supplier]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|unique:suppliers,supplier_kode,' . $id . ',supplier_id|max:10',
                'supplier_nama' => 'required|string|max:100',
                'name_supplier' => 'required|string|max:100',
            'supplier_contact' => 'required|string|max:20',
            'supplier_alamat' => 'required|string|max:255',
            'supplier_email' => 'required|string|max:100',
            'supplier_aktif' => 'required|boolean',
            'supplier_keterangan' => 'nullable|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $supplier = Supplier::find($id);
            if ($supplier) {
                $supplier->update($request->all());
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

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = Supplier::find($id);
            if ($supplier) {
                try {
                    $supplier->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak bisa dihapus'
                    ]);
                }
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
