@extends('admin.layouts.master')
@section('title', 'Manajemen Kategori')

@section('css')
<link rel="stylesheet" crossorigin href="{{ asset('assets/extensions/simple-datatables/style.css') }}" crossorigin>
<link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/table-datatable.css') }}" crossorigin>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-lg-9 col-sm-12">
                <h3>Daftar Kategori</h3>
                <p class="text-subtitle text-muted">Informasi kategori menu yang terdaftar</p>
            </div>
            <div class="col-lg-3 col-sm-12">
                <a href="{{ route('categories.create') }}" class="btn btn-primary float-start float-lg-end">
                    <i class="bi bi-plus"></i>
                    Tambah Kategori
                </a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        <h5 class="alert-heading"><i class="bi bi-check-circle-fill"></i> Berhasil!</h5>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->cat_name }}</td>
                            <td>{{ $category->description ?? '-' }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Ubah
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>
@endsection
