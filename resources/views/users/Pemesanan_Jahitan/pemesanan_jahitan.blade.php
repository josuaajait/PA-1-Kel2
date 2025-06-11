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
    <div class="row justify-content-center align-items-center gy-5">
      <div class="col-xl-5 content">
      <h2>Pemesanan Jahitan</h2>
      <p>Isi form dibawah untuk melakukan pemesanan.</p>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form id="orderForm" action="{{ route('user.pemesanan_jahitan.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Jenis Pakaian</label>
            <select name="jenis_pakaian" id="jenis_pakaian" class="form-select" onchange="updateUkuranTemplate()" required>
              <option disabled selected>-- Pilih Jenis --</option>
              <option value="Kemeja">Kemeja</option>
              <option value="Gaun">Gaun</option>
              <option value="Kebaya">Kebaya</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Bahan</label>
            <select name="bahan" class="form-select" required>
              <option value="" disabled selected>-- Pilih Bahan --</option>
              <option value="Brokat">Brokat</option>
              <option value="Renda">Renda</option>
              <option value="Katun">Katun</option>
              <option value="Linen">Linen</option>
              <option value="Flanel">Flanel</option>
            </select>
          </div>

          <div class="mb-3">
            <label>Warna</label>
            <input type="text" name="warna" class="form-control" required>
          </div>

          <!-- Lingkar Dada -->
          <div class="mb-3 ukuran-field" data-jenis="kemeja,gaun,kebaya">
            <label for="lingkar_dada" class="form-label">Lingkar Dada</label>
            <input type="number" step="0.1" name="lingkar_dada" class="form-control">
          </div>

          <!-- Lingkar Pinggang -->
          <div class="mb-3 ukuran-field" data-jenis="kemeja,gaun,kebaya">
            <label for="lingkar_pinggang" class="form-label">Lingkar Pinggang</label>
            <input type="number" step="0.1" name="lingkar_pinggang" class="form-control">
          </div>

          <!-- Lingkar Pinggul -->
          <div class="mb-3 ukuran-field" data-jenis="gaun,kebaya">
            <label for="lingkar_pinggul" class="form-label">Lingkar Pinggul</label>
            <input type="number" step="0.1" name="lingkar_pinggul" class="form-control">
          </div>

          <!-- Panjang Baju -->
          <div class="mb-3 ukuran-field" data-jenis="gaun,kebaya">
            <label for="panjang_baju" class="form-label">Panjang Baju</label>
            <input type="number" step="0.1" name="panjang_baju" class="form-control">
          </div>

          <!-- Panjang Lengan -->
          <div class="mb-3 ukuran-field" data-jenis="kemeja,kebaya">
            <label for="panjang_lengan" class="form-label">Panjang Lengan</label>
            <input type="number" step="0.1" name="panjang_lengan" class="form-control">
          </div>

          <!-- Lebar Bahu -->
          <div class="mb-3 ukuran-field" data-jenis="kemeja,kebaya">
            <label for="lebar_bahu" class="form-label">Lebar Bahu</label>
            <input type="number" step="0.1" name="lebar_bahu" class="form-control">
          </div>

          <!-- Lingkar Lengan -->
          <div class="mb-3 ukuran-field" data-jenis="kemeja,kebaya">
            <label for="lingkar_lengan" class="form-label">Lingkar Lengan</label>
            <input type="number" step="0.1" name="lingkar_lengan" class="form-control">
          </div>

          <!-- Lingkar Pergelangan -->
          <div class="mb-3 ukuran-field" data-jenis="kemeja,kebaya">
            <label for="lingkar_pergelangan" class="form-label">Lingkar Pergelangan</label>
            <input type="number" step="0.1" name="lingkar_pergelangan" class="form-control">
          </div>

          <!-- Tinggi Badan -->
          <div class="mb-3 ukuran-field" data-jenis="gaun,kebaya">
            <label for="tinggi_badan" class="form-label">Tinggi Badan</label>
            <input type="number" step="0.1" name="tinggi_badan" class="form-control">
          </div>


          <div class="mb-3">
            <label>Referensi Gambar (Opsional)</label>
            <input type="file" name="referensi_gambar" class="form-control">
          </div>

          <div class="mb-3">
          <label class="form-label fw-bold">Informasi Pembayaran</label>
          <div class="border rounded p-3 bg-light">
            <p class="mb-1">Silakan transfer ke rekening berikut:</p>
            <ul class="mb-0">
              <li><strong>Bank:</strong> Mandiri</li>
              <li><strong>Nomor Rekening:</strong> 1720005379195</li>
              <li><strong>Atas Nama:</strong> Mikhael Josua Roganda</li>
              <li><strong>Jumlah Uang Muka:</strong> Rp100.000,00</li>
            </ul>
            <small class="text-danger">* Sertakan bukti pembayaran untuk memproses pemesanan Anda.</small>
          </div>
        </div>

          
          <div class="mb-3">
            <label for="bukti_pembayaran_uang_muka" class="form-label">Bukti Pembayaran Uang Muka (Rp.100.000,00)</label>
            <input type="file" name="bukti_pembayaran_uang_muka" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="bukti_pembayaran_lunas" class="form-label">Bukti Pembayaran Lunas (Opsional)</label>
            <input type="file" name="bukti_pembayaran_lunas" class="form-control">
          </div>
          
        @auth
            <!-- Jika user sudah login -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Kirim Pemesanan</button>
            </div>
        @endauth

        @guest
            <!-- Jika user belum login -->
            <div class="text-center">
                <a href="{{ route('login') }}" class="btn btn-warning">Login untuk Melakukan Pemesanan</a>
            </div>
        @endguest

        </form>

      </div>
    </div>
  </div>
</section>

@include('layout.script')
@include('layout.footer')

<script>
function updateUkuranTemplate() {
	const selectedJenis = document.getElementById("jenis_pakaian").value.toLowerCase(); // convert to lowercase
	const ukuranFields = document.querySelectorAll(".ukuran-field");

	ukuranFields.forEach(field => {
		const jenisList = field.dataset.jenis.toLowerCase().split(',');
		if (jenisList.includes(selectedJenis)) {
			field.style.display = 'block';
		} else {
			field.style.display = 'none';
			const input = field.querySelector("input");
			if (input) input.value = ''; // Kosongkan nilai jika disembunyikan
		}
	});
}

</script>

