<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data About Us</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                    <div class="container-fluid mt-4">
                    <h2>Tambah Modifikasi Jahitan / Produk</h2>

                    <form action="{{ route('admins.modifikasi-jahitan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pemesanan_id" value="{{ $type . '-' . $data->id }}">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Pakaian / Produk</label>
                        <input type="text" name="jenis_pakaian" class="form-control" value="{{ $type === 'produk' ? $data->nama_produk : $data->jenis_pakaian }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Catatan Modifikasi</label>
                        <textarea name="catatan" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('admins.modifikasi-jahitan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>

                </div>
        </div>
</div>
            </main>
@include('layout.adminscript')
    
</body>

@include('layout.adminfooter')
</html>
