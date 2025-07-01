@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transaksi Baru</h2>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <td>
                        <input type="checkbox" name="produk_id[]" value="{{ $p->id }}">
                    </td>
                    <td>{{ $p->nama }}</td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>
                        <input type="number" name="qty[]" class="form-control" min="1" value="1">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        <a href="{{ url('/admin/kasir') }}" class="btn btn-secondary float-end">← Kembali</a>
    </form>
</div>
@endsection
