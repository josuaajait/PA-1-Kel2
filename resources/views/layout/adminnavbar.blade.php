<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="{{URL::asset('adminimg/avatars/avatar.jpg')}}" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Mikhael</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="align-middle me-1" data-feather="log-out"></i> Log out</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>