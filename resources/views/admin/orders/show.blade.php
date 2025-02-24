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
                <h5>Detail Pesanan</h5>
                    
                <div>
                    <strong>Kode Pesanan:</strong>
                    {{ $order->order_code }}
                </div>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Subtotal:</strong> Rp {{ number_format($order->subtotal, 0, ',', '.') }}</p>
                <p><strong>Tax:</strong> Rp {{ number_format($order->tax, 0, ',', '.') }}</p>
                <p><strong>Grant Total:</strong> Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                <p><strong>Meja:</strong> {{ $order->table_number }}</p>
                <p><strong>Metode Bayar:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at }}</p>
            </div>
        </div>

    </section>
</div>
@endsection

@section('js')
<script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
<script src="assets/static/js/pages/simple-datatables.js"></script>
@endsection
