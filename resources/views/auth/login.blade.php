<head>
    <style>
       :root {
    --my-primary-color: #2196F3; /* Biru modern */
    --my-primary-darken-color: #1976D2; /* Biru lebih gelap */
    --my-primary-darkest-color: #0D47A1; /* Biru tua */
    --login-bg-color: #f5f9ff; /* Biru muda lembut */
    --page-bg-color: #ffffff; /* Putih */
}

/* Background utama */
body {
    background: var(--page-bg-color) !important;
    font-family: 'Segoe UI', Arial, sans-serif;
}

/* Container */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 900px;
    margin: 50px auto;
    background: var(--login-bg-color);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    backdrop-filter: blur(6px);
}

/* Input 3D */
.input-3d {
    border: 2px solid #ddd;
    padding: 12px 15px;
    border-radius: 8px;
    box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    width: 100%;
    font-size: 14px;
}

.input-3d:focus {
    border-color: var(--my-primary-color);
    box-shadow: 0 0 12px rgba(33, 150, 243, 0.6);
    outline: none;
}

/* Tombol Login 3D */
.login-btn-3d {
    background: linear-gradient(135deg, var(--my-primary-color), var(--my-primary-darken-color));
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    border: none;
    font-weight: bold;
    letter-spacing: 0.5px;
    box-shadow: 0 8px 15px rgba(33, 150, 243, 0.4);
    transition: all 0.3s ease;
    width: 100%;
}

.login-btn-3d:hover {
    background: linear-gradient(135deg, var(--my-primary-darken-color), var(--my-primary-darkest-color));
    transform: translateY(-2px);
    box-shadow: 0 12px 22px rgba(33, 150, 243, 0.6);
}

.login-btn-3d:active {
    transform: translateY(2px);
}

/* Checkbox 3D */
.checkbox-3d {
    width: 18px;
    height: 18px;
    border: 2px solid var(--my-primary-color);
    border-radius: 4px;
    appearance: none;
    background: #fff;
    box-shadow: 0 3px 6px rgba(33, 150, 243, 0.2);
    transition: all 0.3s ease;
}

.checkbox-3d:checked {
    background: var(--my-primary-color);
    box-shadow: 0 0 10px rgba(33, 150, 243, 0.6);
}

/* Link */
.link-3d {
    color: var(--my-primary-color);
    text-decoration: none;
    font-weight: 500;
}

.link-3d:hover {
    text-decoration: underline;
    color: var(--my-primary-darken-color);
}

/* Judul */
h1.text-primary {
    color: var(--my-primary-darkest-color) !important;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(33, 150, 243, 0.3);
}

h4.text-secondary {
    color: var(--my-primary-color) !important;
    font-weight: 500;
}

    </style>
</head>

<body>
    <x-guest-layout>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="login-container">
            <!-- Image Section -->
            <!-- <div class="login-image"></div> -->
            <img src="{{ asset(get_my_app_config('logo_login')) }}" style="width: 40%" class="mx-auto">

            <!-- Form Section -->
            <div class="form-container">
                <h1 class="text-primary text-center">Selamat Datang</h1>
                                <h4 class="text-center text-secondary">Sistem Klasifikasi Penerima Bantuan</h4>
                <!-- <h2 class="text-center mb-4">Sistem Klasifikasi Penerima Bantuan Program Keluarga Harapan di Beberapa Desa di Kecamatan Panyabungan Kota</h2> -->
                <form method="POST" action="{{ route('login') }}" class="login-form shadow-lg">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="input-3d" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="input-3d" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="checkbox-3d" name="remember">
                            <span class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="link-3d" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ml-3 login-btn-3d">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-guest-layout>
</body>
