@extends('admin.layouts.master')

@section('title', 'Tambah Menu')

@section('css')
<link rel="stylesheet" crossorigin href="{{ asset('assets/extensions/filepond/filepond.css') }}">
<link rel="stylesheet" crossorigin href="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
<link rel="stylesheet" crossorigin href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}">
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tambah Data</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <form class="form form-vertical" method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="name">Nama Menu</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="name" placeholder="Nama Menu" id="name" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="description">Deskripsi</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="description" placeholder="Deskripsi" id="description" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="price">Harga</label>
                                <div class="position-relative">
                                    <input type="number" class="form-control" name="price" placeholder="Harga" id="price" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="category_id">Kategori</label>
                                <div class="position-relative">
                                    <select class="form-control" name="category_id" id="category_id" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="image">Gambar</label>
                                <div class="position-relative">
                                    <input type="file" class="form-control" name="image" id="image">
                                    <div class="form-control-icon">
                                        <i class="bi bi-image"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="is_active">Status Aktif</label>
                                <div class="position-relative">
                                    <select class="form-control" name="is_active" id="is_active" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-toggle-on"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
@endsection
