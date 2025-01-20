@extends('admin.layouts.master')

@section('title', 'Menu | Restoranku')

@section('css')
<link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">

<link rel="stylesheet" crossorigin href="./assets/compiled/css/table-datatable.css">
@endsection

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Menu</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama Item</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description, 15) }}</td>
                            <td>{{ 'Rp' . number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $item->category->cat_name == 'Makanan' ? 'bg-primary' : 'bg-info' }}">
                                    {{ $item->category->cat_name }}
                                </span>
                            </td></td>
                            <td>{{ $item->img }}</td>
                            <td>
                                <span class="badge {{ $item->is_active == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td></td>
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
