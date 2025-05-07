<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Pemesanan Produk</title>
    <link rel="shortcut icon" href="{{ URL::asset('adminimg/icons/icon-48x48.png') }}">
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                <div class="container mt-4">
                    <h1 class="mb-4">Pemesanan Produk</h1>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis Pakaian</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor Telepon</th>
                                    <th>Alamat</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pemesanans as $pemesanan)
                                    <tr>
                                        <td>{{ $pemesanan->id }}</td>
                                        <td>{{ $pemesanan->jenis_pakaian }}</td>
                                        <td>{{ $pemesanan->nama }}</td>
                                        <td>{{ $pemesanan->email }}</td>
                                        <td>{{ $pemesanan->nomor_telepon }}</td>
                                        <td>{{ $pemesanan->alamat }}</td>
                                        <td>{{ $pemesanan->jumlah }}</td>
                                        <td>{{ $pemesanan->status }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data pemesanan produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $pemesanans->links() }}
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
