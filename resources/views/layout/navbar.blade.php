<header id="header" class="header d-flex align-items-center fixed-top bg-transparent">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <h1 class="sitename">Firman Taylor</h1><span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
        <ul>
            <li>
                <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
            </li>

            <li>
                <a href="{{ url('/about-us') }}" class="{{ Request::is('about-us') ? 'active' : '' }}">Tentang</a>
            </li>

            @auth
                {{-- Untuk user yang login --}}
                <li>
                    <a href="{{ route('produk.index') }}" class="{{ Request::is('produk') ? 'active' : '' }}">Produk</a>
                </li>
                <li>
                    <a href="{{ url('/user/pemesanan-jahitan') }}" class="{{ Request::is('user/pemesanan-jahitan') ? 'active' : '' }}">Jahit Produk</a>
                </li>
                <li>
                    <a href="{{ route('user.modifikasi-jahitan.create') }}" class="{{ Request::is('modifikasi-jahitan') ? 'active' : '' }}">Ajukan Modifikasi</a>
                </li>
                <li>
                    <a href="{{ url('/user/riwayat-pemesanan') }}" class="{{ Request::is('user/riwayat-pemesanan') ? 'active' : '' }}">Riwayat Pemesanan</a>
                </li>
            @else
                {{-- Untuk guest --}}
                <li>
                    <a href="{{ url('/pemesanan-jahitan') }}" class="{{ Request::is('pemesanan-jahitan') ? 'active' : '' }}">Jahit Produk</a>
                </li>
                <li>
                    <a href="{{ url('/produk') }}" class="{{ Request::is('produk') ? 'active' : '' }}">Produk</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" onclick="return confirm('Silakan login untuk mengakses fitur ini.')" class="disabled-link">Ajukan Modifikasi</a>
                </li>
                <li>
                    <a href="{{ route('login') }}" onclick="return confirm('Silakan login untuk mengakses fitur ini.')" class="disabled-link">Riwayat Pemesanan</a>
                </li>
            @endauth
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>


        @auth
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ URL::asset('adminimg/avatars/avatar.jpg') }}" alt="Profile" class="rounded-circle"
                        width="40" height="40">
                    <span class="ms-2">{{ auth()->user()->nama }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="{{ route('profil') }}">Profil</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a class="btn-getstarted" href="{{ url('/login') }}">Login</a>
        @endauth

    </div>
</header>
