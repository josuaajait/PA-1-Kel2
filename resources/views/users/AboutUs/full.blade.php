@extends('layout.main')

@section('content')
<style>
  /* Navbar putih dan teks gelap khusus di halaman ini */
  #header, #header.scrolled {
    background-color: #fff !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    z-index: 9999;
  }
  #header a,
  #header .mobile-nav-toggle,
  #header .sitename {
    color: #333 !important;
  }
  #header a:hover,
  #header a.active {
    color: #000 !important;
  }
  /* Dropdown menu */
  #header .dropdown-menu {
    background-color: #fff !important;
    color: #333 !important;
  }
  #header .dropdown-menu .dropdown-item {
    color: #333 !important;
  }
  #header .dropdown-menu .dropdown-item:hover {
    background-color: #f0f0f0;
    color: #000 !important;
  }

  /* Styling timeline image */
  .timeline-image {
    width: 150px;
    height: 150px;
    overflow: hidden;
    border-radius: 50%;
    margin: 0 auto;
  }
  .timeline-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  <style>
    .text-justify {
        text-align: justify;
    }

</style>

<br><br>
<!-- About Section -->
<section class="page-section light-background" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Tentang Kami</h2>
            <h3 class="section-subheading text-muted">Mengenal lebih dekat layanan dan sejarah kami.</h3>
        </div>

        @if ($aboutUs)
        <ul class="timeline">

            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('aboutassets/img/about/1.jpg') }}" alt="Deskripsi" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>Deskripsi</h4>
                        <h4 class="subheading">Siapa Kami</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted text-justify">{{ $aboutUs->deskripsi }}</p>
                    </div>
                </div>
            </li>

            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('aboutassets/img/about/2.jpg') }}" alt="Sejarah" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>Sejarah</h4>
                        <h4 class="subheading">Perjalanan Kami</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted text-justify">{{ $aboutUs->sejarah }}</p>
                    </div>
                </div>
            </li>

            <li>
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('aboutassets/img/about/3.jpg') }}" alt="Visi" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>Visi</h4>
                        <h4 class="subheading">Tujuan Kami</h4>
                    </div>
                    <div class="timeline-body">
                        <p class="text-muted text-justify">{{ $aboutUs->visi }}</p>
                    </div>
                </div>
            </li>

            <li class="timeline-inverted">
                <div class="timeline-image"><img class="rounded-circle img-fluid" src="{{ asset('aboutassets/img/about/4.jpg') }}" alt="Misi" /></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4>Misi</h4>
                        <h4 class="subheading">Langkah Kami</h4>
                    </div>
                    <div class="timeline-body">
                        <ol class="text-muted">
                            @foreach (explode('.', $aboutUs->misi) as $item)
                                @if (trim($item) !== '')
                                    <li>{{ trim($item) }}.</li>
                                @endif
                            @endforeach
                        </ol>

                    </div>
                </div>
            </li>

            <li class="timeline-inverted">
                <div class="timeline-image">
                    <h4>
                        Belilah
                        <br />
                        Produk
                        <br />
                        Kami!
                    </h4>
                </div>
            </li>

        </ul>
        @else
        <div class="alert alert-info text-center fs-5" role="alert">
            Tidak ada informasi yang tersedia saat ini.
        </div>
        @endif
    </div>
</section>

@endsection
