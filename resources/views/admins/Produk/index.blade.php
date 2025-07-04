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
    
    <link href="{{URL::asset('img/firman-taylor-logo-modified.png')}}" rel="icon"> 

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Admin Produk</title>

    <link href="{{URL::asset('admincss/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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
                                            @if($produk->status == 'tersedia')
                                                <span class="badge bg-success">Tersedia</span>
                                            @elseif($produk->status == 'habis')
                                                <span class="badge bg-danger">Habis</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Diketahui</span>
                                            @endif
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
                        {{ $produks->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('layout.adminscript')
</body>

@include('layout.adminfooter')
</html>
