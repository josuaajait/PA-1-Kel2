<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Detail Pemesanan Jahitan</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Detail Pemesanan Jahitan</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Informasi Pemesanan Jahitan</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Nama:</strong> {{ $pemesananJahitan->name }}</p>
                                    <p><strong>Telepon:</strong> {{ $pemesananJahitan->phone }}</p>
                                    <p><strong>Alamat:</strong> {{ $pemesananJahitan->address }}</p>
                                    <p><strong>Jenis:</strong> {{ $pemesananJahitan->jenis }}</p>
                                    <p><strong>Bahan:</strong> {{ $pemesananJahitan->bahan }}</p>
                                    <p><strong>Warna:</strong> {{ $pemesananJahitan->warna }}</p>
                                    <p><strong>Ukuran:</strong> {{ $pemesananJahitan->ukuran }}</p>

                                    <a href="{{ route('pemesanan-jahitan.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
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

