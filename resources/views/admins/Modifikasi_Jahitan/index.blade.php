<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Modifikasi Jahitan & Produk</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
        @include('layout.adminsidebar')
        <div class="main">
            @include('layout.adminnavbar')
            <main class="content">
                <div class="container-fluid mt-4">

                    <h2>Pemesanan Produk</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesananProduk as $index => $produk)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>{{ $produk->jumlah }}</td>
                                    <td>{{ $produk->status ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admins.modifikasi-jahitan.create', ['type' => 'produk', 'id' => $produk->id]) }}" class="btn btn-primary btn-sm">Modifikasi</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h2>Pemesanan Jahitan</h2>
                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Pakaian</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesananJahitan as $index => $jahitan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jahitan->nama }}</td>
                                    <td>{{ $jahitan->jenis_pakaian }}</td>
                                    <td>{{ $jahitan->catatan ?? '-' }}</td>
                                    <td>{{ $jahitan->status ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admins.modifikasi-jahitan.create', ['type' => 'jahitan', 'id' => $jahitan->id]) }}" class="btn btn-primary btn-sm">Modifikasi</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </main>
            @include('layout.adminfooter')
        </div>
    </div>
    @include('layout.adminscript')
</body>
</html>
