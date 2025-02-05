@extends('layouts.master')

@section('title', 'Order Berhasil')

@section('content')

<div class="container py-5 d-flex justify-content-center">
    <div class="receipt border p-4 bg-white shadow" style="width: 350px; text-align: center;">
        <h2 class="text-center mb-3">Struk Pembelian</h2>
        <hr>
        <p class="fw-bold">Kode Bayar: <span class="text-primary">{{ $order_code }}</span></p>
        <hr>
        <h4 class="mb-3">Detail Pesanan</h4>
        <table class="table table-borderless">
            <tbody>
                @foreach ($orderItems as $item)
                <tr>
                    <td>{{ $item['name'] }} ({{ $item['qty'] }})</td>
                    <td class="text-end">Rp{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr class="fw-bold border-top">
                    <td>Total</td>
                    <td class="text-end">Rp{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <p class="small">Tunjukkan kode bayar ini ke kasir untuk menyelesaikan pembayaran.</p>
        <hr>
        <a href="{{ route('menu', ['table' => $tableNumber]) }}" class="btn btn-primary w-100">Kembali ke Menu</a>
    </div>
</div>

@endsection
