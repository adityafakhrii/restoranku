@extends('admin.layouts.master')

@section('title', 'Tambah Kategori')

@section('content')
<div class="page-title">
    <div class="row mb-3">
        <div class="col-lg-9 col-sm-12">
            <h3>Tambah Data Kategori</h3>
            <p class="text-subtitle text-muted">Silakan isi form dengan benar</p>
        </div>
        <div class="col-lg-3 col-sm-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Daftar Kategori</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Kategori</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-content">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill"></i> Gagal</h4>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
            @endif

            <form class="form form-vertical" method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="category_name">Nama Kategori</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="cat_name" placeholder="Nama Kategori" id="category_name" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="description">Deskripsi</label>
                                <div class="position-relative">
                                    <textarea class="form-control" name="description" placeholder="(opsional)" id="description"></textarea>
                                    <div class="form-control-icon">
                                        <i class="bi bi-card-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
