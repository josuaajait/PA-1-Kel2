<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Pemesanan Jahitan</title>
    <link href="{{ URL::asset('admincss/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        @include('layout.adminsidebar')
        <div class="main">
            @include('layout.adminnavbar')

            <main class="content">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="container-fluid mt-4">
                    <h1 class="h3 mb-3">Edit Pemesanan Jahitan</h1>

                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admins.pemesanan-jahitan.update', ['id' => $pemesananJahitan->pemesanan_jahitan_id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="nama" value="{{ old('nama', $pemesananJahitan->nama) }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">No HP</label>
                                            <input type="text" name="no_hp" value="{{ old('no_hp', $pemesananJahitan->no_hp) }}" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <input name="alamat" class="form-control" value="{{ old('alamat', $pemesananJahitan->alamat) }}" required></input>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Jenis Pakaian</label>
                                            <select id="jenis_pakaian" name="jenis_pakaian" class="form-control" onchange="updateUkuranTemplate()" required>
                                                <option value="">-- Pilih Jenis --</option>
                                                <option value="kemeja" {{ old('jenis_pakaian', $pemesananJahitan->jenis_pakaian) == 'kemeja' ? 'selected' : '' }}>Kemeja</option>
                                                <option value="gaun" {{ old('jenis_pakaian', $pemesananJahitan->jenis_pakaian) == 'gaun' ? 'selected' : '' }}>Gaun</option>
                                                <option value="kebaya" {{ old('jenis_pakaian', $pemesananJahitan->jenis_pakaian) == 'kebaya' ? 'selected' : '' }}>Kebaya</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Bahan</label>
                                            <select name="bahan" class="form-control" required>
                                                <option value="">-- Pilih Bahan --</option>
                                                @foreach(['Brokat', 'Renda', 'Katun', 'Linen', 'Flanel'] as $bahan)
                                                    <option value="{{ $bahan }}" {{ old('bahan', $pemesananJahitan->bahan) == $bahan ? 'selected' : '' }}>{{ $bahan }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Warna</label>
                                            <input type="text" name="warna" value="{{ old('warna', $pemesananJahitan->warna) }}" class="form-control" required>
                                        </div>

                                        <h5 class="mt-4 mb-3">Ukuran (Cm)</h5>

                                        <div class="mb-3 ukuran-field" data-jenis="kemeja,gaun,kebaya">
                                            <label class="form-label">Lingkar Dada</label>
                                            <input type="number" step="0.1" name="lingkar_dada" class="form-control" value="{{ old('lingkar_dada', $pemesananJahitan->ukuranPakaian->lingkar_dada ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Lingkar Pinggang</label>
                                            <input type="number" step="0.1" name="lingkar_pinggang" class="form-control" value="{{ old('lingkar_pinggang', $pemesananJahitan->ukuranPakaian->lingkar_pinggang ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Lingkar Pinggul</label>
                                            <input type="number" step="0.1" name="lingkar_pinggul" class="form-control" value="{{ old('lingkar_pinggul', $pemesananJahitan->ukuranPakaian->lingkar_pinggul ?? '') }}">
                                        </div>

                                        <div class="mb-3 ukuran-field" data-jenis="gaun,kebaya">
                                            <label class="form-label">Panjang Baju</label>
                                            <input type="number" step="0.1" name="panjang_baju" class="form-control" value="{{ old('panjang_baju', $pemesananJahitan->ukuranPakaian->panjang_baju ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Panjang Lengan</label>
                                            <input type="number" step="0.1" name="panjang_lengan" class="form-control" value="{{ old('panjang_lengan', $pemesananJahitan->ukuranPakaian->panjang_lengan ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Lebar Bahu</label>
                                            <input type="number" step="0.1" name="lebar_bahu" class="form-control" value="{{ old('lebar_bahu', $pemesananJahitan->ukuranPakaian->lebar_bahu ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Lingkar Lengan</label>
                                            <input type="number" step="0.1" name="lingkar_lengan" class="form-control" value="{{ old('lingkar_lengan', $pemesananJahitan->ukuranPakaian->lingkar_lengan ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Lingkar Pergelangan</label>
                                            <input type="number" step="0.1" name="lingkar_pergelangan" class="form-control" value="{{ old('lingkar_pergelangan', $pemesananJahitan->ukuranPakaian->lingkar_pergelangan ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tinggi Badan</label>
                                            <input type="number" step="0.1" name="tinggi_badan" class="form-control" value="{{ old('tinggi_badan', $pemesananJahitan->ukuranPakaian->tinggi_badan ?? '') }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control" required>
                                                @foreach(['pending', 'diproses', 'dibatalkan', 'selesai'] as $status)
                                                    <option value="{{ $status }}" {{ old('status', $pemesananJahitan->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Referensi Gambar (Opsional)</label>
                                            <input type="file" name="referensi_gambar" class="form-control">
                                            @if($pemesananJahitan->referensi_gambar)
                                                <img src="{{ asset('storage/' . $pemesananJahitan->referensi_gambar) }}" class="img-thumbnail mt-2" width="150">
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

    <script>
        function updateUkuranTemplate() {
            const selectedJenis = document.getElementById("jenis_pakaian").value;
            const ukuranFields = document.querySelectorAll(".ukuran-field");

            ukuranFields.forEach(field => {
                const jenisList = field.dataset.jenis.split(',');
                if (jenisList.includes(selectedJenis)) {
                    field.style.display = 'block';
                } else {
                    field.style.display = 'none';
                    const input = field.querySelector("input");
                    if (input) input.value = '';
                }
            });
        }

        document.addEventListener("DOMContentLoaded", () => {
            updateUkuranTemplate();
            document.getElementById("jenis_pakaian").addEventListener("change", updateUkuranTemplate);
        });
    </script>
</body>
</html>
