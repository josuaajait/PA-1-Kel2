<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1 class="sitename">Firman Taylor</h1><span>.</span>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ url('/about') }}" class="{{ Request::is('about') ? 'active' : '' }}">Tentang</a></li>
        <li><a href="{{ url('/produk') }}" class="{{ Request::is('produk') ? 'active' : '' }}">Produk</a></li>
        <li><a href="{{ url('/pemesanan') }}" class="{{ Request::is('pemesanan') ? 'active' : '' }}">Jahit Produk</a></li>
        <li><a href="{{ url('index.html#pricing') }}" class="{{ Request::is('index.html#pricing') ? 'active' : '' }}">Modifikasi Jahitan</a></li>
        <li><a href="{{ url('index.html#team') }}" class="{{ Request::is('index.html#team') ? 'active' : '' }}">Ulasan</a></li>
        <li><a href="{{ url('index.html#contact') }}" class="{{ Request::is('index.html#contact') ? 'active' : '' }}">Kontak</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>      

    <a class="btn-getstarted" href="{{url('/login')}}">Login</a>

  </div>
</header>
