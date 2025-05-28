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
                                            <option value="{{ $produk->id }}"
                                                data-jenis="{{ $produk->jenis_pakaian }}"
                                                data-harga="{{ $produk->harga }}"
                                                {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                                                {{ $produk->nama }}
                                            </option>
                                        @endforeach
                                    </select>
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

                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required />
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="dikirim" {{ old('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                                    </select>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const produkSelect = document.getElementById('produk_id');
            const jumlahInput = document.getElementById('jumlah');

            function updateTotalHarga() {
                const selectedOption = produkSelect.options[produkSelect.selectedIndex];
                const harga = Number(selectedOption.getAttribute('data-harga')) || 0;
                const jumlah = Number(jumlahInput.value) || 1;
                const total = harga * jumlah;

                let totalHargaDisplay = document.getElementById('total_harga_display');
                if (!totalHargaDisplay) {
                    totalHargaDisplay = document.createElement('div');
                    totalHargaDisplay.id = 'total_harga_display';
                    jumlahInput.parentNode.appendChild(totalHargaDisplay);
                }
                totalHargaDisplay.textContent = `Total Harga: Rp ${total.toLocaleString('id-ID')}`;
            }

            produkSelect.addEventListener('change', updateTotalHarga);
            jumlahInput.addEventListener('input', updateTotalHarga);
            updateTotalHarga();
        });
    </script>
</body>

@include('layout.adminfooter')

</html>
    