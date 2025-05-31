<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Tambah Pemesanan Produk</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')

        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <h1 class="mb-4">Tambah Pemesanan Produk</h1>

                            <form action="{{ route('admins.pemesanan-produk.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="produk_id" class="form-label">Pilih Produk</label>
                                    <select class="form-control" id="produk_id" name="produk_id" required>
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($produks as $produk)
                                            <option value="{{ $produk->produk_id }}"
                                                data-ukuran="{{ $produk->ukuran }}"
                                                data-harga="{{ $produk->harga }}"
                                                data-jenis="{{ $produk->jenis_pakaian }}">
                                                {{ $produk->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="ukuran" class="form-label">Ukuran</label>
                                    <input type="text" class="form-control" id="ukuran" name="ukuran" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga (Rp)</label>
                                    <input type="text" class="form-control" id="harga" name="harga" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required />
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required />
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon') }}" required />
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Pemesanan</button>
                                <a href="{{ route('admins.pemesanan-produk.index') }}" class="btn btn-secondary">Batal</a>
                            </form>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const produkSelect = document.getElementById('produk_id');
        const ukuranInput = document.getElementById('ukuran');
        const hargaInput = document.getElementById('harga');

        produkSelect.addEventListener('change', function () {
            const selected = produkSelect.options[produkSelect.selectedIndex];

            const ukuran = selected.getAttribute('data-ukuran');
            const harga = selected.getAttribute('data-harga');

            ukuranInput.value = ukuran ?? '';
            hargaInput.value = harga ?? '';
        });

        // Trigger once on load in case there's a default value selected
        produkSelect.dispatchEvent(new Event('change'));
    });
</script>
