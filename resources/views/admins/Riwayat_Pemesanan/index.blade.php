<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Riwayat Pemesanan - Admin</title>
    <link href="{{URL::asset('admincss/app.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
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
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jenis Pakaian</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananJahitans as $pj)
                            <tr>
                                <td>{{ $pj->id }}</td>
                                <td>{{ $pj->nama }}</td>
                                <td>{{ $pj->jenis_pakaian }}</td>
                                <td>{{ ucfirst($pj->status) }}</td>
                                <td>{{ $pj->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pemesananJahitans->links() }}

                <hr>

                <h1>Riwayat Pemesanan Produk</h1>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananProduks as $pp)
                            <tr>
                                <td>{{ $pp->id }}</td>
                                <td>{{ $pp->nama }}</td>
                                <td>{{ $pp->produk->jenis_pakaian ?? '-' }}</td>
                                <td>{{ $pp->jumlah }}</td>
                                <td>{{ ucfirst($pp->status) }}</td>
                                <td>{{ $pp->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pemesananProduks->links() }}
            </div>
        </div>
    </div>

    @include('layout.adminscript')
</body>

@include('layout.adminfooter')

</html>
