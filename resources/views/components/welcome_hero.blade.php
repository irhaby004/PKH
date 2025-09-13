<head>
    <style>
        /* Hero Section */
        .hero-welcome {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            overflow: hidden;
        }

        /* Overlay transparan biar teks lebih jelas */
        .hero-welcome::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4));
            z-index: 1;
        }

        .hero-welcome .content {
            position: relative;
            z-index: 2;
            max-width: 900px;
            padding: 20px;
            animation: fadeUp 1s ease-out;
        }

        /* Animasi fade-up */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Teks 3D */
        .hero-welcome h1 {
            font-weight: 800;
            font-size: 2.8rem;
            line-height: 1.4;
            text-shadow: 0 4px 12px rgba(0,0,0,0.6);
        }

        .hero-welcome h4 {
            text-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }

        /* Tombol 3D Rounded */
        .btn-rounded {
            border-radius: 30px;
            padding: 15px 40px;
            font-weight: bold;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            color: var(--my-primary-color);
            background-color: transparent;
            border: 2px solid var(--my-primary-color);
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .btn-rounded:hover {
            background: var(--my-primary-color);
            color: #fff;
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4),
                        0 0 15px rgba(0, 174, 255, 0.6); /* Neon glow */
        }

        .btn-rounded:active {
            transform: translateY(1px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<div class="hero-welcome w-100" style="background: url('{{ get_my_app_config('hero_bg') }}'); background-size:cover; background-position:center;">
    <div class="content text-light">
        <h1 class="fw-bold">
            Sistem Klasifikasi Penerima Bantuan Program Keluarga Harapan di {{ get_my_app_config('nama_dprd2') }}
        </h1>
        <h4 class="mb-5">
            Selamat Datang Di Sistem Klasifikasi Penerima Bantuan Program Keluarga Harapan {{ get_my_app_config('nama_dprd2') }}
        </h4>
        <!-- <a href="#" class="btn btn-rounded">Selengkapnya</a> -->
    </div>
</div>
