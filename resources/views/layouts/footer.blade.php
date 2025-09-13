<div class="footer my-bg shadow">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <div class="d-flex justify-content-center">
                    <span class="btn btn-light my-text-color fw-bold text-uppercase mb-3">Kontak Kami</span>
                </div>
                <table class="table text-light my-table fw-light">
                    <tr>
                        <td><i class="fa fa-location-dot"></i></td>
                        <td>{{ get_my_app_config('alamat') }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-phone"></i></td>
                        <td>{{ get_my_app_config('telpon') }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-envelope"></i></td>
                        <td>{{ get_my_app_config('email') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-3">
                <div class="d-flex justify-content-center">
                    <span class="btn btn-light my-text-color fw-bold text-uppercase mb-3">Quick Menu</span>
                </div>
                <div class="d-flex justify-content-center">
                    <ul class="text-light fw-light">
                        <li>Layanan 24 Jam</li>
                        <li>Profil Puskesmas</li>
                        <li>Kontak Kami</li>
                        <li>Visi & Misi</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex justify-content-center">
                    <span class="btn btn-light my-text-color fw-bold text-uppercase mb-3">Media Sosial</span>
                </div>
                <div class="d-flex flex-column gap-3 justify-content-center align-items-center">
                    <a href="{{ get_my_app_config('link_facebook') }}" class="btn rounded text-light"
                        style="width: 80%; background: #3B5999"><i
                            class="fa-brands fa-fw fa-facebook-square text-light"></i>
                        Facebook</a>
                    <a href="{{ get_my_app_config('link_twitter') }}" class="btn rounded text-light"
                        style="width: 80%; background: #55ACEE"><i
                            class="fa-brands fa-fw fa-twitter-square text-light"></i>
                        Twitter</a>
                    <a href="{{ get_my_app_config('link_instagram') }}" class="btn rounded text-light"
                        style=" width: 80%;background: #f09433;
background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );"><i
                            class="fa-brands fa-fw fa-instagram-square text-light"></i>
                        Instagram</a>
                    <a href="{{ get_my_app_config('link_youtube') }}" class="btn rounded text-light"
                        style=" width: 80%;background: #E42B26"><i
                            class="fa-brands fa-fw fa-youtube-square text-light"></i>
                        Youtube</a>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="d-flex justify-content-center">
                    <span class="btn btn-light my-text-color fw-bold text-uppercase mb-3">Jam Buka</span>
                </div>
                <div class="d-flex justify-content-center">
                    <span class="text-light"><i class="fa fa-clock fa-fw"></i> Kami Buka 24 Jam</span>
                </div>
            </div>
        </div>
    </div>
</div>
