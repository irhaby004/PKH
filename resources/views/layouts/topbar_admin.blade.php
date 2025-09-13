<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top custom-navbar">
    <a class="sidebar-toggle js-sidebar-toggle ms-2">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse justify-content-end">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <!-- icon versi mobile -->
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <!-- versi desktop -->
                <a class="nav-link dropdown-toggle d-none d-sm-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('img/avatars/ahyar.jpg') }}" 
                         class="avatar img-fluid rounded-circle border border-2 border-primary shadow-sm" width="40" height="40"/>
                    <span class="fw-bold text-dark">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end rounded-3 shadow-lg border-0">
                    {{-- <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="align-middle me-1" data-feather="user"></i> Profile
                    </a> --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger fw-semibold">
                            <i class="align-middle me-1" data-feather="log-out"></i> Log out
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<style>
    .custom-navbar {
        background: linear-gradient(135deg, #007bff, #20c997);
        color: #fff;
    }

    .custom-navbar .nav-link,
    .custom-navbar .fw-bold {
        color: #fff !important;
    }

    .custom-navbar .dropdown-menu {
        animation: fadeDown 0.25s ease-in-out;
    }

    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .avatar {
        transition: transform 0.3s ease;
    }
    .avatar:hover {
        transform: scale(1.1);
    }
</style>
