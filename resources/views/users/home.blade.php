@extends('layout.main') 

@section('content')

<style>
  /* Tambahkan class ini untuk efek scroll */
  #header.scrolled {
      background-color: #fff !important;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }
</style>


<!-- Hero Section (Only on landing page) -->
<section id="hero" class="hero section dark-background">
  <img src="{{ URL::asset('img/hero-bg.jpeg') }}" alt="" data-aos="fade-in">
  <div class="container">
    <div class="row">
      <div class="col-lg-10">
        <h2 data-aos="fade-up" data-aos-delay="100">Selamat Datang di Website Taylor Firman</h2>
        <p data-aos="fade-up" data-aos-delay="200">Tempat di mana kualitas jahitan bertemu dengan kreativitas dan ketelitian</p>
      </div>
    </div>
  </div>
</section>

{{-- Any other content --}}
<div class="container mt-5">
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
                                    <a href="{{ route('user.pemesanan-produk.index', $produk->id) }}" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
</div>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>


@endsection
