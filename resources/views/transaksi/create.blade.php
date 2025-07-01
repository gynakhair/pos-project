@extends('layouts.app')

@section('content')
<div class="container">
    {{-- ✅ Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2>Transaksi Baru</h2>

    <form action="{{ route('transaksi.store') }}" method="POST">
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
                                <span class="text-danger">Stok Habis</span>
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

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        <a href="{{ url('/admin/kasir') }}" class="btn btn-secondary">← Kembali</a>
    </form>
</div>
@endsection
