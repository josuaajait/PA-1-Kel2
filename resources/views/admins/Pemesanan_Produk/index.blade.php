<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pemesanan Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    @include('layout.adminsidebar')

    <div class="main">
        @include('layout.adminnavbar')

        <main class="content">
            <div class="container mt-4">

        <h2 class="mb-3">Daftar Produk Tersedia</h2>
        <div class="row mb-5">
            @foreach($produks as $produk)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if($produk->image)
                            <img src="{{ asset('storage/produk_images/' . $produk->image) }}" class="img-fluid mx-auto d-block" alt="{{ $produk->nama }}" style="height: 150px; width: auto; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->nama }}</h5>

                            <p class="card-text">Deskripsi: {{ $produk->deskripsi }}</p>
                            <p class="card-text">Stok: {{ $produk->stok }}</p>
                            <p class="card-text">Status: {{ $produk->status }}</p>
                            <p class="card-text">Ukuran: {{ $produk->ukuran }}</p>
                            <p class="card-text">Jenis: {{ $produk->jenis_pakaian }}</p>
                            <p class="card-text">Bahan: {{ $produk->bahan }}</p>
                            <p class="card-text">Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <a href="{{ route('admins.pemesanan-produk.create', $produk->id) }}" class="btn btn-primary btn-sm">Pesan</a>
                            <a href="{{ route('admins.produk.show', $produk->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('admins.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admins.produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

                <h1 class="mb-4">Daftar Pemesanan Produk</h1>

                <a href="{{ route('admins.pemesanan-produk.create') }}" class="btn btn-primary mb-3">Tambah Pemesanan Produk</a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produk</th>
                            <th>Jenis Pakaian</th>
                            <th>Nama Pemesan</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananProduks as $pemesanan)
                            <tr>
                                <td>{{ $pemesanan->id }}</td>
                                <td>{{ $pemesanan->produk->nama ?? '-' }}</td>
                                <td>{{ $pemesanan->jenis_pakaian }}</td>
                                <td>{{ $pemesanan->nama }}</td>
                                <td>{{ $pemesanan->email }}</td>
                                <td>{{ $pemesanan->nomor_telepon }}</td>
                                <td>{{ $pemesanan->alamat }}</td>
                                <td>{{ $pemesanan->jumlah }}</td>
                                <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="diproses" {{ $pemesanan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="dikirim" {{ $pemesanan->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="selesai" {{ $pemesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="batal" {{ $pemesanan->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                </td>
                                <td>
                                    <a href="{{ route('admins.pemesanan-produk.show', $pemesanan->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('admins.pemesanan-produk.edit', $pemesanan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admins.pemesanan-produk.destroy', $pemesanan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pemesanan ini?');">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <div class="mt-3">
                            {{ $pemesananProduks->links() }}

                        </div>

                </table>
                </div>
            </div>
        </main>

    </div>
</div>

@include('layout.adminscript')
</body>

@include('layout.adminfooter')
</html>
