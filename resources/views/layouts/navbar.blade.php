<head>
    <style>
        /* Top info bar (logo, email, telpon) */
        .topbar {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .topbar h1 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .topbar .icon {
            font-size: 1.3rem;
            color: var(--my-primary-color);
        }

        .topbar span {
            font-size: 0.9rem;
        }

        /* Navbar 3D */
        .my-navbar {
            background: linear-gradient(135deg, var(--my-primary-color), #1565c0);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            border-radius: 0 0 15px 15px;
        }

        .navbar-nav .nav-link {
            position: relative;
            font-weight: 600;
            color: #fff !important;
            transition: all 0.3s ease;
        }

        /* Hover underline animation */
        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 3px;
            background: #fff;
            border-radius: 2px;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 60%;
        }

        /* 3D Login Button */
        .btn-rounded {
            border-radius: 30px;
            font-weight: bold;
            border: 2px solid #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .btn-rounded:hover {
            background: #fff;
            color: var(--my-primary-color) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.4),
                        0 0 10px rgba(255,255,255,0.6);
        }
    </style>
</head>

<div class="sticky-top">
    <!-- Top info bar -->
    <div class="topbar">
        <div class="container">
            <div class="row py-2">
                <div class="col-lg-4 col-sm-4 d-flex align-items-center gap-3 mb-3 mb-lg-0">
                    <img src="{{ asset(get_my_app_config('logo')) }}" height="50" class="me-2">
                    <div class="d-flex flex-column">
                        <h1>{!! get_my_app_config('nama_dprd') !!}</h1>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4 d-flex align-items-center gap-3 mb-3 mb-lg-0">
                    <i class="fa fa-envelope icon"></i>
                    <div class="d-flex flex-column">
                        <span class="text-muted">Email</span>
                        <span>{{ get_my_app_config('email') }}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-4 d-flex align-items-center gap-3 mb-3 mb-lg-0">
                    <i class="fa fa-phone icon"></i>
                    <div class="d-flex flex-column">
                        <span class="text-muted">Telpon</span>
                        <span>{{ get_my_app_config('telpon') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="shadow my-navbar navbar navbar-expand-lg navbar-dark py-3">
        <div class="container">
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-3">
                        <a class="nav-link @if (request()->routeIs('home')) active @endif"
                           href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link @if (request()->routeIs('predict.*')) active @endif"
                           href="{{ route('predict.index') }}">Hasil Klasifikasi SVM</a>
                    </li>
                    <!-- <li class="nav-item mx-3"> <a class="nav-link @if (request()->routeIs('about')) active @endif" href="{{ route('about') }}">About</a> </li> -->
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-rounded px-4"
                           href="{{ route('login') }}">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
