@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Produk</h2>
        <a href="/admin" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>

    {{-- ✅ Flash message sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('produk.create') }}" class="btn btn-success mb-3">+ Tambah Produk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Barcode</th>
                <th>Gambar Barcode</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->barcode }}</td>
                    <td>
                        @if($p->barcode)
                            {!! DNS1D::getBarcodeHTML($p->barcode, 'C128') !!}
                        @else
                            <span class="text-muted">Belum ada</span>
                        @endif
                    </td>
                    <td>
                        @if ($p->stok <= 0)
                            <span class="badge bg-danger">Habis</span>
                            <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-sm btn-info mt-1">Isi Stok</a>
                        @else
                            {{ $p->stok }}
                        @endif
                    </td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('produk.destroy', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
