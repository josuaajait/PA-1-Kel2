<header id="header" class="header d-flex align-items-center fixed-top bg-light shadow">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
            <h1 class="sitename">Firman Taylor</h1><span>.</span>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                <li><a href="{{ url('/about') }}" class="{{ Request::is('about') ? 'active' : '' }}">Tentang</a></li>

                @auth
                    @if (auth()->user()->isAdmin())
                        <li><a href="{{ route('admins.produk.index') }}" class="{{ Request::is('admin/produk*') ? 'active' : '' }}">Produk</a></li>
                        <li><a href="{{ route('admins.modifikasi-jahitan.index') }}" class="{{ Request::is('admin/modifikasi-jahitan*') ? 'active' : '' }}">Modifikasi Jahitan</a></li>
                    @else
                        <li><a href="{{ route('users.produk') }}" class="{{ Request::is('produk') ? 'active' : '' }}">Produk</a></li>
                    @endif
                @else
                    <li><a href="{{ route('users.produk') }}" class="{{ Request::is('produk') ? 'active' : '' }}">Produk</a></li>
                @endauth

                <li><a href="{{ url('/pemesanan-jahitan') }}" class="{{ Request::is('pemesanan-jahitan') ? 'active' : '' }}">Jahit Produk</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @auth
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ URL::asset('adminimg/avatars/avatar.jpg') }}" alt="Profile" class="rounded-circle"
                        width="40" height="40">
                    <span class="ms-2">{{ auth()->user()->name }}</span>
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
