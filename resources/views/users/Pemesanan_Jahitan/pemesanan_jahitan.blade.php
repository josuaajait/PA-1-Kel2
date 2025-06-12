@include('layout.header')
@include('layout.navbar')

<style>
    #header.scrolled {
        background-color: #fff !important;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<br><br><br><br>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section id="pemesanan" class="pemesanan section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h2 class="mb-4 text-center">Form Pemesanan Jahitan</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <form action="{{ route('user.pemesanan_jahitan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text">+62</span>
                                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_telepon ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Pakaian</label>
                                <select name="jenis_pakaian" id="jenis_pakaian" class="form-select" onchange="updateUkuranTemplate()" required>
                                    <option disabled selected>-- Pilih Jenis --</option>
                                    <option value="Kemeja">Kemeja</option>
                                    <option value="Gaun">Gaun</option>
                                    <option value="Kebaya">Kebaya</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bahan</label>
                                <select name="bahan" class="form-select" required>
                                    <option disabled selected>-- Pilih Bahan --</option>
                                    <option value="Brokat">Brokat</option>
                                    <option value="Renda">Renda</option>
                                    <option value="Katun">Katun</option>
                                    <option value="Linen">Linen</option>
                                    <option value="Flanel">Flanel</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Warna</label>
                                <input type="text" name="warna" class="form-control" required>
                            </div>

                            <h5 class="mt-4 mb-3">Ukuran (Cm)</h5>

                            @php
                                $ukuranFields = [
                                    'lingkar_dada' => 'Lingkar Dada',
                                    'lingkar_pinggang' => 'Lingkar Pinggang',
                                    'lingkar_pinggul' => 'Lingkar Pinggul',
                                    'panjang_baju' => 'Panjang Baju',
                                    'panjang_lengan' => 'Panjang Lengan',
                                    'lebar_bahu' => 'Lebar Bahu',
                                    'lingkar_lengan' => 'Lingkar Lengan',
                                    'lingkar_pergelangan' => 'Lingkar Pergelangan',
                                    'tinggi_badan' => 'Tinggi Badan',
                                ];
                            @endphp

                            @foreach ($ukuranFields as $field => $label)
                                <div class="mb-3 ukuran-field" data-jenis="kemeja,gaun,kebaya">
                                    <label class="form-label" for="{{ $field }}">{{ $label }}</label>
                                    <input type="number" step="0.1" name="{{ $field }}" class="form-control" value="{{ old($field) }}">
                                </div>
                            @endforeach

                            <div class="mb-3">
                                <label class="form-label">Referensi Gambar (Opsional)</label>
                                <input type="file" name="referensi_gambar" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Informasi Pembayaran</label>
                                <div class="p-3 bg-light border rounded">
                                    <p>Silakan transfer ke rekening berikut:</p>
                                    <ul>
                                        <li><strong>Bank:</strong> Mandiri</li>
                                        <li><strong>Nomor Rekening:</strong> 1720005379195</li>
                                        <li><strong>Atas Nama:</strong> Mikhael Josua Roganda</li>
                                        <li><strong>Uang Muka:</strong> Rp100.000,00</li>
                                    </ul>
                                    <small class="text-danger">* Sertakan bukti pembayaran untuk memproses pemesanan Anda.</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bukti Pembayaran Uang Muka</label>
                                <input type="file" name="bukti_pembayaran_uang_muka" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bukti Pembayaran Lunas (Opsional)</label>
                                <input type="file" name="bukti_pembayaran_lunas" class="form-control">
                            </div>

                            @auth
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
                                </div>
                            @endauth

                            @guest
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="btn btn-warning">Login untuk Melakukan Pemesanan</a>
                                </div>
                            @endguest
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.script')
@include('layout.footer')

<script>
function updateUkuranTemplate() {
    const selectedJenis = document.getElementById("jenis_pakaian").value.toLowerCase();
    const ukuranFields = document.querySelectorAll(".ukuran-field");

    ukuranFields.forEach(field => {
        const jenisList = field.dataset.jenis.toLowerCase().split(',');
        if (jenisList.includes(selectedJenis)) {
            field.style.display = 'block';
        } else {
            field.style.display = 'none';
            const input = field.querySelector("input");
            if (input) input.value = '';
        }
    });
}
</script>
