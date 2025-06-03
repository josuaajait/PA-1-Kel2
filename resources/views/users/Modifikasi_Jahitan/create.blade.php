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

<section id="modifikasi" class="section light-background">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row justify-content-center align-items-center gy-5">
      <div class="col-xl-6 content">
        <h3>Form Modifikasi Pakaian</h3>
        <h2>Ajukan Permintaan Modifikasi</h2>
        <p>Isi formulir di bawah ini untuk mengajukan permintaan modifikasi pakaian Anda.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
              </ul>
          </div>
        @endif

      <form action="{{ route('user.modifikasi-jahitan.store') }}" method="POST">
          @csrf

          <div class="mb-3">
              <label for="pemesanan" class="form-label">Pilih Pemesanan Selesai</label>
              <select name="pemesanan" id="pemesanan" class="form-select" required>
                  <option value="" disabled selected>-- Pilih salah satu --</option>
                  @foreach($pemesananProduks as $item)
                      <option value="produk|{{ $item->pemesanan_produk_id }}">
                          [Produk] {{ $item->jenis_pakaian }} - {{ $item->nama }}
                      </option>
                  @endforeach
                  @foreach($pemesananJahitans as $item)
                      <option value="jahitan|{{ $item->pemesanan_jahitan_id }}">
                          [Jahitan] {{ $item->jenis_pakaian }} - {{ $item->nama }}
                      </option>
                  @endforeach
              </select>
          </div>

          <div class="mb-3">
              <label for="catatan" class="form-label">Catatan Modifikasi</label>
              <textarea name="catatan" id="catatan" class="form-control" rows="4" required>{{ old('catatan') }}</textarea>
          </div>

          <div class="d-grid">
              <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
          </div>
      </form>

      </div>
    </div>
  </div>
</section>

@include('layout.script')
@include('layout.footer')
