<?php

if (!function_exists('get_my_app_config')) {
    function get_my_app_config($key)
    {
        $config =  [
            'logo'             => 'img/logo3.jpg',
            'favicon'          => 'img/logo3.jpg',
            'logo_login'       => 'img/pkh.jpg',
            'hero_bg'          => asset('img/pyb.jpg'),
            'nama_dprd'        => 'Kecamatan Panyabungan Kota',
            'nama_dprd2'       => 'Kecamatan Panyabungan Kota',
            'email'            => 'parinduriahyar@gmail.com',
            'telpon'           => '082195600329',
            'kontak_darurat'   => '082195600329',
            'alamat'           => 'Sabajior',
            'link_facebook'    => 'Khoirul Ahyar',
            'link_twitter'     => 'Khoirul Ahyar',
            'link_instagram'   => 'Khoirul Ahyar',
            'link_youtube'     => 'Khoirul Ahyar',
            'APP_NAME'         => 'Klasifikasi Penerima Bantuan',
        ];

        return $config[$key];
    }
}
