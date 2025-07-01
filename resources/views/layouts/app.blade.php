<!DOCTYPE html>
<html>
<head>
    <title>POS App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/admin') }}">POS App</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    @if(Auth::check())
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('produk.index') }}">Produk</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Manajemen User</a></li>
                        @elseif(Auth::user()->role === 'kasir')
                            <li class="nav-item"><a class="nav-link" href="{{ url('/transaksi/create') }}">Transaksi</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('transaksi.riwayat') }}">Riwayat</a></li>
                        @endif
                    @endif
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/logout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
