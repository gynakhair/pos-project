<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - POS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">POS App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/logout" class="btn btn-outline-light">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten --}}
    <div class="container py-4">
        <h2 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Produk</h5>
                        <p class="card-text">Tambah, ubah, atau hapus produk. Termasuk barcode dan stok.</p>
                        <a href="/produk" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Transaksi</h5>
                        <p class="card-text">Lihat riwayat penjualan dan detail transaksi kasir.</p>
                        <a href="/transaksi" class="btn btn-primary">Lihat Transaksi</a>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Manajemen User</h5>
                        <p class="card-text">Atur akun admin & kasir. Kontrol akses dan hak pengguna.</p>
                        <a href="/users" class="btn btn-primary">Kelola User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
