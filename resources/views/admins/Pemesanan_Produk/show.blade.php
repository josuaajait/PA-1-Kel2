<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Detail Pemesanan Produk</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">

        @include('layout.adminsidebar')

        <div class="main">

            @include('layout.adminnavbar')

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Detail Pemesanan Produk</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th>Produk</th>
                                            <td>{{ $pemesananProduk->produk->nama ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Pakaian</th>
                                            <td>{{ $pemesananProduk->jenis_pakaian ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Pemesan</th>
                                            <td>{{ $pemesananProduk->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $pemesananProduk->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Telepon</th>
                                            <td>{{ $pemesananProduk->nomor_telepon }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $pemesananProduk->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah</th>
                                            <td>{{ $pemesananProduk->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Harga</th>
                                            <td>Rp {{ number_format($pemesananProduk->total_harga, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ ucfirst($pemesananProduk->status) }}</td>
                                        </tr>
                                    </table>

                                    <a href="{{ route('admins.pemesanan-produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @include('layout.adminfooter')

        </div>
    </div>

    @include('layout.adminscript')
</body>

</html>
