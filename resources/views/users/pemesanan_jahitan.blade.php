@include('layout.header')
@include('layout.navbar')
<br><br><br><br>

<section id="pemesanan" class="pemesanan section light-background">
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row justify-content-center align-items-center gy-5">
      <div class="col-xl-5 content">
        <h3>Pemesanan</h3>
        <h2>Order your custom clothing</h2>
        <p>Fill out the form below to place your order.</p>

        {{-- Mulai form di sini, semua field & tombol harus di dalam --}}
        <form id="orderForm"
              action="{{ (Auth::check() && Auth::user()->role=='admin') 
                          ? route('admins.pemesanan-jahitan.store') 
                          : route('pemesanan_jahitan.store') }}"
              method="POST">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Pakaian</label>
            <select name="jenis" id="jenis" class="form-select" required>
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

          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        {{-- Form ditutup di sini --}}
        
      </div>
    </div>
  </div>
</section>

@include('layout.script')
@include('layout.footer')

@if(Auth::check() && Auth::user()->role!='admin')
  {{-- Hanya user yang pakai AJAX --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(function(){
    $('#orderForm').submit(function(e){
      e.preventDefault();
      $.ajax({
        url:   $(this).attr('action'),
        type:  'POST',
        data:  $(this).serialize(),
        dataType: 'json',
        success(res){
          alert(res.success);
          $('#orderForm')[0].reset();
        },
        error(xhr){
          console.error(xhr.responseText);
          alert('Terjadi kesalahan.');
        }
      });
    });
  });
  </script>
@endif
