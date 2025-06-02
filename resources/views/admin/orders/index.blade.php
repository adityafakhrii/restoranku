@extends('admin.layouts.master')

@section('title', 'Manajemen Pesanan')

@section('css')
<link rel="stylesheet" crossorigin href="{{ asset('assets/extensions/simple-datatables/style.css') }}" crossorigin>
<link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/table-datatable.css') }}" crossorigin>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-lg-9 col-sm-12">
                <h3>Daftar Pesanan</h3>
                <p class="text-subtitle text-muted">Informasi pesanan yang terdaftar</p>
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
                            <th>Kode Pesanan</th>
                            <th>Nama Lengkap</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>No. Meja</th>
                            <th>Metode Pembayaran</th>
                            <th>Catatan</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_code }}</td>
                            <td>{{ $order->user->fullname }}</td>
                            <td>{{ $order->grand_total }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-danger">{{ $order->status }}</span>
                                @elseif($order->status == 'settlement')
                                    <span class="badge bg-success">{{ $order->status }}</span>
                                @elseif($order->status == 'cooked')
                                    <span class="badge bg-primary">{{ $order->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                                @endif
                            </td></td>
                            <td>{{ $order->table_number }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->notes ? $order->notes : '-' }}</td>
                            <td>{{ $order->created_at->format('d-m-Y, H:i') }}</td>
                            <td>
                                @if(Auth::user()->role->role_name == 'admin' || Auth::user()->role->role_name == 'cashier')
                                    @if($order->payment_method == 'tunai' && $order->status == 'pending')
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-succ ess btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengkonfirmasi pembayaran?')">
                                                <i class="bi bi-cash"></i> Bayar
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-primary">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-white">
                                                <i class="bi bi-eye"></i> Lihat Detail
                                            </a>
                                        </span>
                                    @endif
                                @elseif(Auth::user()->role->role_name == 'chef')
                                    @if($order->status == 'settlement')

                                        <span class="badge bg-primary">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-white">
                                                <i class="bi bi-eye"></i> Lihat Detail
                                            </a>
                                        </span>
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin ingin memulai memasak pesanan ini?')">
                                                <i class="bi bi-egg-fried"></i> Masak
                                            </button>
                                        </form>
                                    @elseif($order->status == 'cooked')
                                    <span class="badge bg-primary">
                                        <a href="{{ route('orders.show', $order->id) }}" class="text-white">
                                            <i class="bi bi-eye"></i> Lihat Detail
                                        </a>
                                    </span>
                                    @elseif($order->status == 'pending')
                                        <span class="badge bg-secondary">Menunggu Pembayaran</span>
                                    @endif
                                @endif
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
