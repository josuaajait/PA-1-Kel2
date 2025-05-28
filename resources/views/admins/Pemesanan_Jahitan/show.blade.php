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
                                    <p><strong>Nama:</strong> {{ $pemesananJahitan->nama }}</p>
                                    <p><strong>Telepon:</strong> {{ $pemesananJahitan->no_hp }}</p>
                                    <p><strong>Alamat:</strong> {{ $pemesananJahitan->alamat }}</p>
                                    <p><strong>Jenis:</strong> {{ $pemesananJahitan->jenis_pakaian }}</p>
                                    <p><strong>Bahan:</strong> {{ $pemesananJahitan->bahan }}</p>
                                    <p><strong>Warna:</strong> {{ $pemesananJahitan->warna }}</p>
                                    <p><strong>Ukuran:</strong> {{ $pemesananJahitan->ukuran }}</p>
                                    <p><strong>Status:</strong>
                                    @if($pemesananJahitan->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($pemesananJahitan->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Diketahui</span> <!-- Menangani status lain -->
                                    @endif
                                    </p>
                                    <p><strong>Gambar Referensi:</strong>
                                    @if($pemesananJahitan->referensi_gambar)
                                        <a href="{{ asset('storage/' . $pemesananJahitan->referensi_gambar) }}" target="_blank">
                                            Lihat Gambar
                                        </a>
                                    @else
                                        -
                                    @endif
                                    </p>

                                    <a href="{{ route('admins.pemesanan-jahitan.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
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

