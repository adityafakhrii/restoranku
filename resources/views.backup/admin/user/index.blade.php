@extends('admin.layouts.master')

@section('title', 'Manajemen Karyawan')

@section('css')
<link rel="stylesheet" crossorigin href="{{ asset('assets/extensions/simple-datatables/style.css') }}" crossorigin>

<link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/table-datatable.css') }}" crossorigin>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-lg-9 col-sm-12">
                <h3>Daftar Karyawan</h3>
                <p class="text-subtitle text-muted">Informasi karyawan yang terdaftar</p>
            </div>
            <div class="col-lg-3 col-sm-12">
                <a href="{{ route('users.create') }}" class="btn btn-primary float-start float-lg-end">
                    <i class="bi bi-plus"></i>
                    Tambah Karyawan
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
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role->role_name }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Ubah
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">
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
