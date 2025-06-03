<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Riwayat Pemesanan - Admin</title>
    <link href="{{URL::asset('admincss/app.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('img/firman-taylor-logo-modified.png')}}" rel="icon"> 
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />

    <style>
    .pagination {
        display: flex !important;
        flex-wrap: wrap;
        list-style: none !important;
        padding-left: 0 !important;
        justify-content: center; /* or flex-start/space-between etc */
        margin-top: 1rem;
    }

    .page-item {
        margin: 0 0.25rem;
    }

    .page-link {
        display: block;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        color: #007bff;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
</style>

</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <div class="container mt-4">
                <h1>Riwayat Pemesanan Jahitan</h1>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Pemesanan Jahitan</th>
                            <th>Nama</th>
                            <th>Jenis Pakaian</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananJahitans as $pj)
                            <tr>
                                <td>{{ $pj->pemesanan_jahitan_id }}</td>
                                <td>{{ $pj->nama }}</td>
                                <td>{{ $pj->jenis_pakaian }}</td>
                                <td>{{ ucfirst($pj->status) }}</td>
                                <td>{{ $pj->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pemesananJahitans->links('vendor.pagination.bootstrap-4') }}
                <hr>

                <h1>Riwayat Pemesanan Produk</h1>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Pemesanan Produk</th>
                            <th>Nama</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananProduks as $pp)
                            @foreach($pp->produks as $produk)
                            <tr>
                                <td>{{ $pp->pemesanan_produk_id }}</td>
                                <td>{{ $pp->nama }}</td>
                                <td>{{ $produk->pivot->nama_produk ?? $produk->nama ?? '-' }}</td>
                                <td>Rp {{ number_format($pp->total_harga, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($pp->status) }}</td>
                                <td>{{ $pp->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                {{ $pemesananProduks->links('vendor.pagination.bootstrap-4') }}
                <hr>
                <h1>Riwayat Pengajuan Modifikasi</h1>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Pengajuan Modifikasi</th>
                            <th>Nama</th>
                            <th>Jenis Pakaian</th>
                            <th>Catatan</th>
                            <th>Tanggal Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananModifikasis as $pm)
                            <tr>
                                <td>{{ $pm->modifikasi_jahitan_id }}</td>
                                <td>{{ $pm->nama }}</td>
                                <td>{{ $pm->jenis_pakaian }}</td>
|                                <td>{{ $pm->catatan }}</td>
                                <td>{{ $pm->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pemesananModifikasis->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>

    @include('layout.adminscript')
</body>

@include('layout.adminfooter')

</html>
