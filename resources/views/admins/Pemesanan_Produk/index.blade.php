<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pemesanan Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
    
  <link href="{{URL::asset('img/firman-taylor-logo-modified.png')}}" rel="icon"> 

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

        <main class="content">
            <div class="container mt-4">
                <h1 class="mb-4">Daftar Pemesanan Produk</h1>
                <a href="{{ route('admins.pemesanan-produk.create') }}" class="btn btn-primary mb-3">Tambah Pemesanan Produk</a>
        <div class="row mb-5">
            

                

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Pemesanan Produk</th>
                            <th>Produk</th>
                            <th>Jenis Pakaian</th>
                            <th>Nama Pemesan</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananProduks as $pemesanan)
                            <tr>
                                <td>{{ $pemesanan->pemesanan_produk_id }}</td>
                                <td>
                                    @foreach($pemesanan->produks as $produk)
                                        {{ $produk->pivot->nama_produk ?? $produk->nama }} <br>
                                    @endforeach
                                </td>
                                <td>{{ $pemesanan->jenis_pakaian }}</td>
                                <td>{{ $pemesanan->nama }}</td>
                                <td>{{ $pemesanan->email }}</td>
                                <td>{{ $pemesanan->nomor_telepon }}</td>
                                <td>{{ $pemesanan->alamat }}</td>
                                <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <select name="status" id="status" class="form-control">
                                        <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="diproses" {{ $pemesanan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $pemesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="batal" {{ $pemesanan->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="{{ route('admins.pemesanan-produk.show', $pemesanan->pemesanan_produk_id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('admins.pemesanan-produk.edit', $pemesanan->pemesanan_produk_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admins.pemesanan-produk.destroy', $pemesanan->pemesanan_produk_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pemesanan ini?');">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                        <div class="mt-3">
                            {{ $pemesananProduks->links('vendor.pagination.bootstrap-4') }}

                        </div>

                </table>
        </div>
                </div>
            </div>
        </main>

    </div>
</div>

@include('layout.adminscript')
</body>

@include('layout.adminfooter')
</html>
