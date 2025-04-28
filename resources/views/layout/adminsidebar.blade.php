<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Admin</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/admin') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/admin/tentang') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Tentang Kami</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/admin/produk') }}">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Produk</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/admin/pemesanan-jahitan') }}">
                    <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Pemesanan Jahit</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/admin/modifikasi') }}">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Modifikasi Jahitan</span>
                </a>
            </li>

            <!-- New Pemesanan Produk Button -->
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/admin/pemesanan-produk') }}">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">Pemesanan Produk</span>
                </a>
            </li>

            <li class="sidebar-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link align-middle">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
