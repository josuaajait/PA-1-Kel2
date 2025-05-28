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
                <h1>Edit Produk</h1>
                <form action="{{ route('admins.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $produk->nama }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_pakaian" class="form-label">Jenis Pakaian</label>
                        <select class="form-control" id="jenis_pakaian" name="jenis_pakaian" required>
                            <option value="">-- Pilih Jenis Pakaian --</option>
                            <option value="Kemeja" {{ $produk->jenis_pakaian === 'Kemeja' ? 'selected' : '' }}>Kemeja</option>
                            <option value="Gaun" {{ $produk->jenis_pakaian === 'Gaun' ? 'selected' : '' }}>Gaun</option>
                            <option value="Kebaya" {{ $produk->jenis_pakaian === 'Kebaya' ? 'selected' : '' }}>Kebaya</option>
                            <option value="Rok" {{ $produk->jenis_pakaian === 'Rok' ? 'selected' : '' }}>Rok</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $produk->deskripsi }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{ $produk->harga }}" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ $produk->stok }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="tersedia" {{ $produk->status === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="habis" {{ $produk->status === 'habis' ? 'selected' : '' }}>Habis</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="ukuran" class="form-label">Ukuran</label>
                        <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{ $produk->ukuran }}">
                    </div>

                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna</label>
                        <input type="text" class="form-control" id="warna" name="warna" value="{{ $produk->warna }}">
                    </div>

                    <div class="mb-3">
                        <label for="bahan" class="form-label">Bahan</label>
                        <input type="text" class="form-control" id="bahan" name="bahan" value="{{ $produk->bahan }}">
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                        @if($produk->gambar)
                            <img src="{{ asset('storage/produk_images/' . $produk->gambar) }}" alt="{{ $produk->nama }}" style="max-width: 100px;">
                        @endif

                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            </div>
            @include('layout.adminscript')
        </div>

        @include('layout.adminfooter')
    </body>
    </html>
