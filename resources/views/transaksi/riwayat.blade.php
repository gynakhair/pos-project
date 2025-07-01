@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Transaksi</h2>

    @if ($transaksis->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $trx)
                <tr>
                    <td>{{ $trx->tanggal }}</td>
                    <td>
                        <ul>
                            @foreach ($trx->details as $d)
                                <li>{{ $d->produk->nama }} x {{ $d->qty }} = Rp {{ number_format($d->qty * $d->harga, 0, ',', '.') }}</li>
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

    <a href="{{ url('/admin/kasir') }}" class="btn btn-secondary">← Kembali</a>
</div>
@endsection
