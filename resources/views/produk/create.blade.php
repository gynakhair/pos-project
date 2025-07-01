@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaksi Baru</h2>
    <form action="{{ url('/transaksi') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Barcode</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        @if($product->stok > 0)
                            <input type="checkbox" name="produk_id[]" value="{{ $product->id }}">
                        @else
                            <span class="badge bg-danger">Stok Habis</span>
                        @endif
                    </td>
                    <td>{!! DNS1D::getBarcodeHTML($product->barcode, 'C128') !!}</td>
                    <td>{{ $product->nama }}</td>
                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($product->stok > 0)
                            <input type="number" name="qty[{{ $product->id }}]" class="form-control" value="1" min="1" max="{{ $product->stok }}">
                        @else
                            <input type="number" class="form-control" value="0" disabled>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary">Simpan Transaksi</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">← Kembali</a>
    </form>
</div>
@endsection
