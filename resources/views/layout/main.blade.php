@include('layout.header')
<body class="index-page">

  @include('layout.navbar')
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="{{URL::asset('img/hero-bg.jpg')}}" alt="" data-aos="fade-in">
      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 data-aos="fade-up" data-aos-delay="100">Welcome to Our Website</h2>
            <p data-aos="fade-up" data-aos-delay="200">We are a team of talented designers making websites with Bootstrap</p>
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->
  
  @yield('content')

  </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  @include('layout.script')
</body>
@include('layout.footer')
</html>
