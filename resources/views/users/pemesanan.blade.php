@include('layout.header')
@include('layout.navbar')
<br><br><br><br>
<!-- Services Section -->
<section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Pemesanan</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">
        
          
        <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="200">
          <div class="service-item d-flex">
            <div class="icon flex-shrink-0"><i class="bi bi-card-checklist"></i></div>
            <div>
              <h4 class="title"><a href="services-details.html" class="stretched-link">Dolor Sitema</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="300">
          <div class="service-item d-flex">
            <div class="icon flex-shrink-0"><i class="bi bi-bar-chart"></i></div>
            <div>
              <h4 class="title"><a href="services-details.html" class="stretched-link">Sed ut perspiciatis</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="400">
          <div class="service-item d-flex">
            <div class="icon flex-shrink-0"><i class="bi bi-binoculars"></i></div>
            <div>
              <h4 class="title"><a href="services-details.html" class="stretched-link">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="500">
          <div class="service-item d-flex">
            <div class="icon flex-shrink-0"><i class="bi bi-brightness-high"></i></div>
            <div>
              <h4 class="title"><a href="services-details.html" class="stretched-link">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-lg-6 " data-aos="fade-up" data-aos-delay="600">
          <div class="service-item d-flex">
            <div class="icon flex-shrink-0"><i class="bi bi-calendar4-week"></i></div>
            <div>
              <h4 class="title"><a href="services-details.html" class="stretched-link">Eiusmod Tempor</a></h4>
              <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
            </div>
          </div>
        </div><!-- End Service Item -->

      </div>

    </div>

  </section><!-- /Services Section -->

   <!-- Features Section -->
   <section id="features" class="features section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Features</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4 align-items-center features-item">
        <div class="col-lg-5 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h3>Corporis temporibus maiores provident</h3>
          <p>
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
          </p>
          <a href="#" class="btn btn-get-started">Get Started</a>
        </div>
        <div class="col-lg-7 order-1 order-lg-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
          <div class="image-stack">
            <img src="{{URL::asset('img/features-light-1.jpg')}}" alt="" class="stack-front">
            <img src="{{URL::asset('img/features-light-2.jpg')}}" alt="" class="stack-back">
          </div>
        </div>
      </div><!-- Features Item -->

      <div class="row gy-4 align-items-stretch justify-content-between features-item ">
        <div class="col-lg-6 d-flex align-items-center features-img-bg" data-aos="zoom-out">
          <img src="{{URL::asset('img/features-light-3.jpg')}}" class="img-fluid" alt="">
        </div>
        <div class="col-lg-5 d-flex justify-content-center flex-column" data-aos="fade-up">
          <h3>Sunt consequatur ad ut est nulla</h3>
          <p>Cupiditate placeat cupiditate placeat est ipsam culpa. Delectus quia minima quod. Sunt saepe odit aut quia voluptatem hic voluptas dolor doloremque.</p>
          <ul>
            <li><i class="bi bi-check"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
            <li><i class="bi bi-check"></i><span> Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
            <li><i class="bi bi-check"></i> <span>Facilis ut et voluptatem aperiam. Autem soluta ad fugiat</span>.</li>
          </ul>
          <a href="#" class="btn btn-get-started align-self-start">Get Started</a>
        </div>
      </div><!-- Features Item -->

    </div>

  </section><!-- /Features Section -->



@include('layout.script')

@include('layout.footer')