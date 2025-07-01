@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Kasir</h2>

    {{-- Notifikasi Transaksi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            <h4>{{ session('success') }}</h4>
            <p>Total Pembayaran: <strong>Rp {{ number_format(session('total'), 0, ',', '.') }}</strong></p>
            <p>Terima kasih telah melakukan transaksi.</p>
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <p>Halo, {{ Auth::user()->name }}! Silakan mulai transaksi penjualan.</p>
            <a href="{{ url('/transaksi/create') }}" class="btn btn-primary">Mulai Transaksi</a>
            <a href="{{ route('transaksi.riwayat') }}" class="btn btn-outline-secondary">Riwayat Transaksi</a>
            <a href="{{ url('/logout') }}" class="btn btn-danger float-end">Logout</a>
        </div>
    </div>
</div>
@endsection
