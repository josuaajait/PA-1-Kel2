@include('layout.header')
@include('layout.navbar')
<br><br><br><br>

<!-- Pemesanan Section -->
<section id="pemesanan" class="pemesanan section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center align-items-center gy-5">
            <div class="col-xl-5 content">
                <h3>Pemesanan</h3>
                <h2>Order your custom clothing</h2>
                <p>Fill out the form below to place your order.</p>
                <form id="orderForm" action="{{ route('users.rincian_ukuran') }}" method="post">
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
                            <option value="Brokat">Brokat(Gaun dan Kebaya)</option>
                            <option value="Renda">Renda(Gaun dan Kebaya)</option>
                            <option value="Katun">Katun(Semua Jenis Pakaian)</option>
                            <option value="Linen">Linen(Kemeja)</option>
                            <option value="Flanel">Flanel(Kemeja)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="warna" class="form-label">Warna</label>
                        <input type="text" name="warna" id="warna" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="modifikasi" class="form-label">Catatan</label>
                        <textarea name="modifikasi" id="modifikasi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@include('layout.script')
@include('layout.footer')
