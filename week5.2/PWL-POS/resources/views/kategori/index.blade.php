@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Kategori')

@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Kategori</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
            <div class="card-tools p-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="/kategori/create" class="btn btn-sm btn-success rounded-pill shadow-sm">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah Kategori
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
