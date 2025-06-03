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

          <div class="mb-3">
            <label>Ukuran</label>
            <textarea id="ukuran" name="ukuran" class="form-control" rows="9" required></textarea>
          </div>

          <div class="mb-3">
            <label>Referensi Gambar (Opsional)</label>
            <input type="file" name="referensi_gambar" class="form-control">
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
    const jenis = document.getElementById('jenis_pakaian').value;
    const textarea = document.getElementById('ukuran');
    let template = '';

    if (jenis.toLowerCase() === 'kemeja') {
      template = `Lingkar Dada    : 
Lingkar Pinggang: 
Lingkar Pinggul : 
Lebar Bahu      : 
Panjang Lengan  : 
Lingkar Lengan  : 
Panjang Baju    : 
Lingkar Leher   : 
Tinggi Badan    : `;
    } else if (jenis.toLowerCase() === 'kebaya') {
      template = `Lingkar Dada    : 
Lingkar Pinggang: 
Lingkar Pinggul : 
Lebar Bahu      : 
Panjang Lengan  : 
Lingkar Lengan  : 
Panjang Kebaya  : 
Lingkar Leher   : 
Tinggi Badan    : `;
    } else if (jenis.toLowerCase() === 'gaun') {
      template = `Lingkar Dada        : 
Lingkar Pinggang    : 
Lingkar Pinggul     : 
Lebar Bahu          : 
Panjang Lengan      : 
Lingkar Lengan      : 
Panjang Gaun        : 
Lingkar Leher       : 
Tinggi Badan        : 
Tinggi Hak Sepatu   : `;
    }

    textarea.value = template;
  }
</script>
