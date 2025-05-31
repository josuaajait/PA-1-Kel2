<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{URL::asset('adminimg/icons/icon-48x48.png')}}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Admin Produk</title>

    <link href="{{URL::asset('admincss/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')


                    <div class="container mt-4">
                        <h1>Detail Produk</h1>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $produk->nama }}</h5>
                                <p class="card-text"><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
                                <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                <p class="card-text"><strong>Status:</strong> {{ ucfirst($produk->status) }}</p>
                                <p class="card-text"><strong>Ukuran:</strong> {{ $produk->ukuran ?? '-' }}</p>
                                <p class="card-text"><strong>Warna:</strong> {{ $produk->warna ?? '-' }}</p>
                                <p class="card-text"><strong>Bahan:</strong> {{ $produk->bahan ?? '-' }}</p>
                                @if($produk->gambar)
                                    <div class="mt-3">
                                        <p>Gambar Produk:</p>
                                      <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama }}" style="max-width: 300px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('admins.produk.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Produk</a>
                    </div>
        </div>
    </div>

    @include('layout.adminscript')
</body>

@include('layout.adminfooter')
</html>
