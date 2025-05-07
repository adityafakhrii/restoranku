@extends('admin.layouts.master')

@section('title', 'Edit Menu')

@section('content')
<div class="page-title">
    <div class="row mb-3">
        <div class="col-lg-9 col-sm-12">
            <h3>Edit Data Menu</h3>
            <p class="text-subtitle text-muted">Silakan isi form dengan benar</p>
        </div>
        <div class="col-lg-3 col-sm-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('items.index') }}">Daftar Menu</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Menu</li>
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
                <h4 class="alert-heading">Submit error!</h4>
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-file-excel"></i> {{ $error }}</li>
                @endforeach
            </div>
            @endif

            <form class="form form-vertical" method="POST" action="{{ route('items.update', $item->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="name">Nama Menu</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="name" placeholder="Nama Menu" id="name" value="{{ $item->name }}" required>
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
                                    <textarea class="form-control" name="description" placeholder="Deskripsi" id="description" required>{{ $item->description }}</textarea>
                                    <div class="form-control-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="price">Harga</label>
                                <div class="position-relative">
                                    <input type="number" class="form-control" name="price" placeholder="Harga" id="price" value="{{ $item->price }}" required>
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
                                        <option value="" disabled>Pilih Kategori Menu</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                @if ($item->img)`
                                    <div class="mt-2">
                                        <img src="{{ asset('img_item_upload/' . $item->img) }}" alt="{{ $item->name }}" class="img-thumbnail" width="200" onerror="this.onerror=null;this.src='{{ $item->img }}';">
                                    </div>
                                @endif
                                <br>
                                <input type="file" class="form-control" name="img" id="image">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="is_active">Status</label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Aktif/Tidak Aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <a href="{{ route('items.index') }}" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
