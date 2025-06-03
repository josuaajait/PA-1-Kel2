@include('layout.header')
@include('layout.navbar')

<style>
   #header.scrolled {
    background-color: white !important;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}


    .card-img-top {
    height: 200px; /* Ukuran seragam */
    object-fit: cover; /* Potong proporsional */
    width: 100%;
}

    .pagination {
        display: flex !important;
        flex-wrap: wrap;
        list-style: none !important;
        padding-left: 0 !important;
        justify-content: center; /* or flex-start/space-between etc */
        margin-top: 1rem;
    }

    .page-item {
        margin: 0 0.25rem;
    }

    .page-link {
        display: block;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        color: #007bff;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
</style>
<br><br><br><br>

<!-- Produk Section -->
<section id="produk" class="produk section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">
            <div class="col-xl-12">
                <h2>Produk Kami</h2>
                <div class="row">
                    @foreach($produks as $produk)
                        <div class="col-md-3">
                            <div class="card mb-4 ">
                                <img src="{{ asset('storage/produk_images/' . $produk->gambar) }}" class="card-img-top" alt="{{ $produk->nama }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produk->nama }}</h5>
                                    <p><strong>Jenis Pakaian:</strong> {{ $produk->jenis_pakaian }}</p>
                                    <p><strong>Harga:</strong> {{ $produk->harga }}</p>
                                    <p><strong>Ukuran:</strong> {{ $produk->ukuran }}</p>
                                    <p><strong>Warna:</strong> {{ $produk->warna }}</p>
                                    <p><strong>Bahan:</strong> {{ $produk->bahan }}</p>
                                    <p><strong>Status:</strong> 
                                        <span class="badge {{ $produk->status == 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($produk->status) }}
                                        </span>
                                    </p>
                                    @auth
                                    <a href="{{ route('user.pemesanan-produk.create', ['produkId' => $produk->produk_id]) }}" class="btn btn-primary">
                                    Pesan Sekarang
                                    </a>
                                @endauth

                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-warning">Login to Order</a>
                                @endguest
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $produks->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End Produk Section -->

@include('layout.script')
@include('layout.footer')
