@extends('admin.layouts.master')

@section('title', 'Edit Karyawan')

@section('content')
<div class="page-title">
    <div class="row mb-3">
        <div class="col-lg-9 col-sm-12">
            <h3>Edit Data Karyawan</h3>
            <p class="text-subtitle text-muted">Silakan isi form dengan benar</p>
        </div>
        <div class="col-lg-3 col-sm-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar Karyawan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Karyawan</li>
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

            <form class="form form-vertical" method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="name">Nama Karyawan</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="fullname" placeholder="Nama Karyawan" id="name" value="{{ $user->fullname }}" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="username">Username</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="username" placeholder="Username" id="username" value="{{ $user->username }}" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="phone">Nomor Telepon</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="phone" placeholder="Nomor Telepon" id="phone" value="{{ $user->phone }}" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="role">Role</label>
                                <div class="position-relative">
                                    <select class="form-control" name="role_id" id="role" required>
                                        <option value="" disabled>Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-briefcase"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="email">Email</label>
                                <div class="position-relative">
                                    <input type="email" class="form-control" name="email" placeholder="Email" id="email" value="{{ $user->email }}" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="password">Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    <div class="form-control-icon"><i class="bi bi-lock"></i></div>
                                    <small><a href="#" class="toggle-password" data-target="password">Show Password</a></small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group has-icon-left">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password">
                                    <div class="form-control-icon"><i class="bi bi-lock"></i></div>
                                    <small><a href="#" class="toggle-password" data-target="password_confirmation">Show Password</a></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <a href="{{ route('users.index') }}" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".toggle-password").forEach(el => {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            let input = document.getElementById(this.dataset.target);
            let isHidden = input.type === "password";
            input.type = isHidden ? "text" : "password";
            document.querySelector(`a[data-target="${this.dataset.target}"]`).textContent = isHidden ? "Hide Password" : "Show Password";
        });
    });
</script>

@endsection
