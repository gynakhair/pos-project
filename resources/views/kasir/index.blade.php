@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Kasir</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('kasir.store') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $produk)
                <tr>
                    <td>
                        {{ $produk->nama }} <br>
                        <small>Rp {{ number_format($produk->harga, 0, ',', '.') }}</small>
                        <input type="hidden" name="produk_id[]" value="{{ $produk->id }}">
                    </td>
                    <td>
                        <input type="number" name="qty[]" class="form-control" min="0" value="0">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>
@endsection
