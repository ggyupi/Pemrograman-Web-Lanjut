@extends('layouts.app')

@section('subtitle', 'Barang')
@section('content_header_title', 'Barang')
@section('content_header_subtitle', 'Edit')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Barang</h3>
            </div>
            <form method="post" action="{{ route('barang.update', $barang->barang_id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="barang_kode">Kode Barang</label>
                        <input type="text" class="form-control" id="barang_kode" name="barang_kode"
                            value="{{ $barang->barang_kode }}" placeholder="Masukkan kode barang">
                    </div>
                    <div class="form-group">
                        <label for="barang_nama">Nama Barang</label>
                        <input type="text" class="form-control" id="barang_nama" name="barang_nama"
                            value="{{ $barang->barang_nama }}" placeholder="Masukkan nama barang">
                    </div>
                    <div class="form-group">
                        <label for="kategori_id">Kategori ID</label>
                        <input type="text" class="form-control" id="kategori_id" name="kategori_id"
                            value="{{ $barang->kategori_id }}" placeholder="Masukkan kategori id">
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="text" class="form-control" id="harga_jual" name="harga_jual"
                            value="{{ $barang->harga_jual }}" placeholder="Masukkan harga jual">
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="text" class="form-control" id="harga_beli" name="harga_beli"
                            value="{{ $barang->harga_beli }}" placeholder="Masukkan harga beli">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection