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

    <!-- About Section -->
    <section id="about" class="about page-section light-background">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-xl-center gy-5">
                <div class="col-xl-5 text-center">
                <img src="{{ URL::asset('img/about-pict.png') }}" alt="Profile Image" class="img-fluid rounded">
                    <div class="social-icons mt-3">
                    <a href="https://wa.me/6285372803750" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; background-color: #25D366; color: white; padding: 12px 20px; border-radius: 8px; font-size: 18px; text-decoration: none;">
                        <i class="bi bi-whatsapp"style="font-size: 24px; margin-right: 8px;"></i>
                        Chat via WhatsApp
                    </a>

                    </div>
                </div>
                <div class="col-xl-7 content">
                    <h3>Tentang Kami</h3>
                    <h2>Professional & Antusias</h2>
                    <p style="text-align: justify;">
    Selamat datang di Firman Taylor, tempat di mana kualitas jahitan bertemu dengan kreativitas dan ketelitian. Kami adalah tim penjahit profesional yang berdedikasi untuk menghadirkan pakaian berkualitas tinggi dengan desain yang elegan dan nyaman dikenakan.  

    Dengan pengalaman bertahun-tahun dalam industri fashion dan tailor-made clothing, kami berkomitmen untuk memberikan layanan terbaik bagi pelanggan kami. Mulai dari jahitan custom, modifikasi pakaian, hingga pembuatan seragam dan busana eksklusif, kami memastikan setiap detail dikerjakan dengan presisi dan ketelitian tinggi.  

    Di Firman Taylor, kami percaya bahwa setiap pakaian bukan hanya sekadar kain yang dijahit, tetapi juga cerminan dari gaya dan kepribadian Anda. Oleh karena itu, kami selalu berusaha memberikan hasil terbaik sesuai dengan keinginan dan kebutuhan pelanggan.  

    Terima kasih telah mempercayakan kebutuhan jahitan Anda kepada kami. Kami siap membantu Anda tampil lebih percaya diri dengan pakaian yang pas dan sempurna! ✂️✨
                
                    <a href="{{ route('user.about.full') }}" class="read-more">
                        <span>Baca Selengkapnya</span><i class="bi bi-arrow-right"></i>
                    </a>
                    
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