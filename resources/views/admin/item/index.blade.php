@extends('admin.layouts.master')

@section('title', 'Menu')

@section('css')
<link rel="stylesheet" crossorigin href="{{ asset('assets/extensions/simple-datatables/style.css') }}" crossorigin>

<link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/table-datatable.css') }}" crossorigin>
@endsection

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-lg-9 col-sm-12">
                <h3>Daftar Menu</h3>
                <p class="text-subtitle text-muted">Berbagai pilihan menu terbaik!</p>
            </div>
            <div class="col-lg-3 col-sm-12">
                <a href="{{ route('items.create') }}" class="btn btn-primary float-start float-lg-end">
                    <i class="bi bi-plus"></i>
                    Tambah Menu
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
                            <th>Gambar</th>
                            <th>Nama Item</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('img_item_upload/' . $item->img) }}" alt="{{ $item->name }}" width="60" onerror="this.onerror=null;this.src='{{ $item->img }}';">
                            </td>
                            <td style="width: 20%;">{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description, 15) }}</td>
                            <td>{{ 'Rp' . number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $item->category->cat_name == 'Makanan' ? 'bg-warning' : 'bg-info' }}">
                                    {{ $item->category->cat_name }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $item->is_active == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Ubah
                                </a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
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
<script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="assets/static/js/pages/simple-datatables.js"></script>
@endsection
