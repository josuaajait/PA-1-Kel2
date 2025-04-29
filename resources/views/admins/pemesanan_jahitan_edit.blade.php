<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Pemesanan Jahitan</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Edit Pemesanan Jahitan</h1>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('pemesanan-jahitan.update', $pemesananJahitan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="name" value="{{ old('name', $pemesananJahitan->name ?? '') }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Telepon</label>
                                            <input type="text" name="phone" value="{{ old('phone', $pemesananJahitan->phone ?? '') }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="address" class="form-control" required>{{ old('address', $pemesananJahitan->address ?? '') }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jenis</label>
                                            <input type="text" name="jenis" value="{{ old('jenis', $pemesananJahitan->jenis ?? '') }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Bahan</label>
                                            <input type="text" name="bahan" value="{{ old('bahan', $pemesananJahitan->bahan ?? '') }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Warna</label>
                                            <input type="text" name="warna" value="{{ old('warna', $pemesananJahitan->warna ?? '') }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Ukuran</label>
                                            <textarea name="ukuran" class="form-control" required>{{ old('ukuran', $pemesananJahitan->ukuran ?? '') }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a href="{{ route('pemesanan-jahitan.index') }}" class="btn btn-secondary">Batal</a>
                                    </form>
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
