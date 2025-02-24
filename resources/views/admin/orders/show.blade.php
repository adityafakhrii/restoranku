@extends('admin.layouts.master')

@section('title', 'Detail Pesanan')

@section('css')
<link rel="stylesheet" crossorigin href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
<link rel="stylesheet" crossorigin href="{{ asset('assets/compiled/css/table-datatable.css') }}">
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-lg-9 col-sm-12">
                <h3>Detail Pesanan</h3>
                <p class="text-subtitle text-muted">Informasi lengkap pesanan</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Kode Pesanan: {{ $order->order_code }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge bg-{{ $order->status == 'cooked' ? 'primary' : ($order->status == 'settlement' ? 'success' : ($order->status == 'pending' ? 'danger' : 'warning')) }}">
                                {{ $order->status }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Meja:</strong> {{ $order->table_number }}</p>
                        <p><strong>Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</p>
                        @if(Auth::user()->role->role_name == 'chef' && $order->status == 'settlement')
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin ingin memulai memasak pesanan ini?')">
                                <i class="bi bi-egg-fried"></i> Masak
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                <p><strong>Catatan:</strong> {{ $order->notes ?? '-' }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Detail Pesanan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="">
                            <tr>
                                <th>Gambar</th>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $detail)
                            <tr>
                                <td>
                                    <img src="{{ asset('img_item_upload/' . $detail->item->img )}}"
                                         class="img-fluid rounded-circle"
                                         style="width: 70px; height: 70px;"
                                         alt="{{ $detail->item->name }}"
                                         onerror="this.onerror=null;this.src='{{ $detail->item->img }}';">
                                </td>
                                <td>{{ $detail->item->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td><strong>Subtotal</strong></td>
                                <td><strong>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>PPN (10%)</td>
                                <td>Rp {{ number_format($order->tax, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td><strong>Total</strong></td>
                                <td><strong>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/simple-datatables.js') }}"></script>
@endsection
