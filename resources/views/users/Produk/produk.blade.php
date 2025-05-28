@include('layout.header')
@include('layout.navbar')

<style>
    /* Tambahkan class ini untuk efek scroll */
    #header.scrolled {
        background-color: #fff !important;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
  </style>
  
<br><br><br><br>

<!-- Produk Section -->
<section id="produk" class="produk section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">
            <div class="col-xl-12">
                <h3>Produk</h3>
                <h2>Our Products</h2>
                <div class="row">
                    @foreach($produks as $produk)
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <img src="{{ asset('storage/produk_images/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produk->nama }}</h5>
                                    <p><strong>Jenis Pakaian:</strong> {{ $produk->jenis_pakaian }}</p>
                                    <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
                                    <p><strong>Harga:</strong> {{ $produk->harga }}</p>
                                    <p><strong>Stok:</strong> {{ $produk->stok }}</p>
                                    <p><strong>Ukuran:</strong> {{ $produk->ukuran }}</p>
                                    <p><strong>Warna:</strong> {{ $produk->warna }}</p>
                                    <p><strong>Bahan:</strong> {{ $produk->bahan }}</p>
                                    <p><strong>Status:</strong> 
                                        <span class="badge {{ $produk->status == 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($produk->status) }}
                                        </span>
                                    </p>
                                    <a href="{{ route('user.pemesanan-produk.create', $produk->id) }}" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Produk Section -->

@include('layout.script')
@include('layout.footer')
