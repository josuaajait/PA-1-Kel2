@include('layout.header')
@include('layout.navbar')

<br><br><br><br>

<!-- About Section -->
<section id="about" class="about section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">
            <div class="col-xl-5 text-center">
                <img src="{{ URL::asset('img/about-pict.jpeg') }}" alt="Profile Image" class="img-fluid rounded">
                <div class="social-icons mt-3">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <div class="col-xl-7 content">
                <h3>About Us</h3>
                <h2>Professional & Passionate</h2>

                @if($aboutUs)
                    <p style="text-align: justify;">
                        {{ Str::limit($aboutUs->deskripsi, 300) }}
                    </p>

                    <!-- Collapsible Content -->
                    <div class="collapse" id="full-description">
                        <h4>Sejarah</h4>
                        <p style="text-align: justify;">
                            {{ $aboutUs->sejarah }}
                        </p>

                        <h4>Visi</h4>
                        <p style="text-align: justify;">
                            {{ $aboutUs->visi }}
                        </p>

                        <h4>Misi</h4>
                        <p style="text-align: justify;">
                            {{ $aboutUs->misi }}
                        </p>
                    </div>

                    <!-- Read More / Less Button -->
                    @guest
                    <!-- Jika belum login -->
                    <a href="{{ route('login') }}" class="read-more">
                        <span>Read More</span><i class="bi bi-arrow-right"></i>
                    </a>
                @else
                    <!-- Jika sudah login -->
                    <a href="#full-description" class="read-more" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="full-description">
                        <span>Read More</span><i class="bi bi-arrow-right"></i>
                    </a>
                @endguest
                
                @else
                    <p>Konten About Us belum tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- End About Section -->

<!-- Stats Section -->
<section id="stats" class="stats section dark-background">
    <img src="{{URL::asset('img/stats-bg.jpg')}}" alt="" data-aos="fade-in">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Pelanggan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Produk</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Jam Kerja</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stats-item text-center w-100 h-100">
                    <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Pekerja</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Stats Section -->

@include('layout.footer')
@include('layout.script')
