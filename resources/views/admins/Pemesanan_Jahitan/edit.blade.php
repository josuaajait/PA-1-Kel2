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
                                   <form action="{{ route('admins.pemesanan-jahitan.update', ['id' => $pemesananJahitan->pemesanan_jahitan_id]) }}" method="POST">
                                    @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="nama" value="{{ old('nama', $pemesananJahitan->nama ?? '') }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Telepon</label>
                                            <input type="text" name="no_hp" value="{{ old('no_hp', $pemesananJahitan->no_hp ?? '') }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat" class="form-control" required>{{ old('alamat', $pemesananJahitan->alamat ?? '') }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jenis</label>
                                            <input type="text" name="jenis_pakaian" value="{{ old('jenis_pakaian', $pemesananJahitan->jenis_pakaian ?? '') }}" class="form-control" required>
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

                                        <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-control" required>
                                            <option value="pending" @if(old('status', $pemesananJahitan->status) == 'pending') selected @endif>Pending</option>
                                            <option value="selesai" @if(old('status', $pemesananJahitan->status) == 'selesai') selected @endif>Selesai</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Referensi Gambar (Opsional)</label>
                                        <input type="file" name="referensi_gambar" class="form-control">
                                        @if($pemesananJahitan->referensi_gambar)
                                            <img src="{{ asset('storage/' . $pemesananJahitan->referensi_gambar) }}" alt="Referensi Gambar" class="img-thumbnail mt-2" width="150">
                                        @endif
                                    </div>

                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a href="{{ route('admins.pemesanan-jahitan.index') }}" class="btn btn-secondary">Batal</a>
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
