@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Laporan Transaksi</h2>
        <a href="/admin" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>


    @if ($transaksis->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Detail</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $trx)
                <tr>
                    <td>{{ $trx->tanggal }}</td>
                    <td>
                        <ul>
                            @foreach ($trx->details as $item)
                                <li>{{ $item->produk->nama }} x {{ $item->qty }} = Rp {{ number_format($item->qty * $item->harga, 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td><strong>Rp {{ number_format($trx->total, 0, ',', '.') }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada transaksi.</p>
    @endif
</div>
@endsection
