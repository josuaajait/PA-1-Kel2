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
                <div class="row">
                    <div class="col-md-12"><br>
                        <h1>Produk</h1>
                        <a href="{{ route('admins.produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Jenis Pakaian</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Ukuran</th> <!-- Kolom baru -->
                                    <th>Warna</th>  <!-- Kolom baru -->
                                    <th>Bahan</th>  <!-- Kolom baru -->
                                    <th>Status</th>
                                    <th>Gambar</th>
                                    <th>Actions</th> <!-- Add this column -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produks as $produk)
                                    <tr>
                                        <td>{{ $produk->produk_id }}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>{{ $produk->jenis_pakaian}}</td>
                                        <td>{{ $produk->deskripsi }}</td>
                                        <td>{{ $produk->harga }}</td>
                                        <td>{{ $produk->ukuran }}</td> <!-- Menampilkan ukuran -->
                                        <td>{{ $produk->warna }}</td>  <!-- Menampilkan warna -->
                                        <td>{{ $produk->bahan }}</td>  <!-- Menampilkan bahan -->
                                        <td>
                                            <select name="status" id="status" class="form-control">
                                                <option value="tersedia" {{ old('status', $produk->status ?? '') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                                <option value="habis" {{ old('status', $produk->status ?? '') == 'habis' ? 'selected' : '' }}>Habis</option>
                                            </select>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/produk_images/' . $produk->gambar) }}" alt="{{ $produk->nama }}" style="max-width: 100px;">
                                        </td>
                                        <td>
                                            <!-- View (Read) Button -->
                                            <a href="{{ route('admins.produk.show', $produk) }}" class="btn btn-info btn-sm">View</a>

                                            <!-- Edit Button -->
                                           <a href="{{ route('admins.produk.edit', $produk) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <form action="{{ route('admins.produk.destroy', $produk) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>                            
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('layout.adminscript')
</body>

@include('layout.adminfooter')
</html>
