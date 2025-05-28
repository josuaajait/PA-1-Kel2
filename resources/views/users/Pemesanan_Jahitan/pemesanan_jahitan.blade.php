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

<section id="pemesanan" class="pemesanan section light-background">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row justify-content-center align-items-center gy-5">
      <div class="col-xl-5 content">
        <h3>Pemesanan</h3>
        <h2>Order your custom clothing</h2>
        <p>Fill out the form below to place your order.</p>

        <form id="orderForm" action="{{ auth()->check() && auth()->user()->role === 'admin' 
      ? route('admins.pemesanan-jahitan.store') 
      : route('user.pemesanan_jahitan.store') }}" method="POST" enctype="multipart/form-data">


      @csrf


          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="no_hp" class="form-label">No Ponsel</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="jenis_pakaian" class="form-label">Jenis Pakaian</label>
            <select name="jenis_pakaian" id="jenis_pakaian" class="form-select" required>
              <option selected disabled>Pilih jenis pakaian</option>
              <option value="Kemeja">Kemeja</option>
              <option value="Gaun">Gaun</option>
              <option value="Kebaya">Kebaya</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="bahan" class="form-label">Bahan</label>
            <select name="bahan" id="bahan" class="form-select" required>
              <option selected disabled>Pilih bahan pakaian</option>
              <option value="Brokat">Brokat (Gaun & Kebaya)</option>
              <option value="Renda">Renda (Gaun & Kebaya)</option>
              <option value="Katun">Katun</option>
              <option value="Linen">Linen</option>
              <option value="Flanel">Flanel</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="warna" class="form-label">Warna</label>
            <input type="text" name="warna" id="warna" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <textarea name="ukuran" id="ukuran" class="form-control" rows="4" required></textarea>
          </div>

          <div class="mb-3">
          <label for="referensi_gambar" class="form-label">Referensi Gambar (opsional)</label>
          <input type="file" name="referensi_gambar" id="referensi_gambar" class="form-control" accept="image/*">
        </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</section>

@include('layout.script')
@include('layout.footer')

@if(Auth::check() && Auth::user()->role!='admin')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(function(){
  $('#orderForm').submit(function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,  // wajib supaya data tidak diubah jadi query string
        contentType: false,  // wajib supaya content-type di-set otomatis
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function(res) {
            alert(res.success);
            $('#orderForm')[0].reset();
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            let errors = xhr.responseJSON?.errors;
            if (errors) {
                let messages = Object.values(errors).flat().join('\n');
                alert(messages);
            } else {
                alert('Terjadi kesalahan: ' + xhr.statusText);
            }
        }
    });
});
});
  </script>
@endif