@include('layout.header')
@include('layout.navbar')
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
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="{{ asset('storage/produk_images/' . $produk->image) }}" class="card-img-top" alt="{{ $produk->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produk->name }}</h5>
                                    <p class="card-text">{{ $produk->description }}</p>
                                    <p class="card-text"><strong>Price:</strong> {{ $produk->price }}</p>
                                    <a href="{{ route('pemesanan.create', $produk->id) }}" class="btn btn-primary">Order Now</a>
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
