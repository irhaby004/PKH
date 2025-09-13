<head>
    <style>
        /* Background gradient lembut */
        .bg-3d-light {
            background: linear-gradient(135deg, #f8f9fa, #e3f2fd, #ede7f6);
        }

        /* Gambar 3D */
        .img-custom {
            border-radius: 15px;
            border: 5px solid var(--my-primary-color);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.25),
                        0 8px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .img-custom:hover {
            transform: scale(1.05) rotateX(4deg) rotateY(-4deg);
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.35),
                        0 12px 18px rgba(0, 0, 0, 0.15);
        }

        /* Card teks 3D */
        .text-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15),
                        inset 0 2px 4px rgba(255, 255, 255, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .text-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.25);
        }

        /* Judul */
        .section-title {
            font-weight: 700;
            color: #1976d2;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .service-row {
            margin-bottom: 70px;
        }
    </style>
</head>

<div class="bg-3d-light">
    <div class="container py-5">
        <h2 class="section-title text-center mb-5">🌟 Layanan Kami</h2>

        <!-- Bagian 3: Foto peta daerah + link Google Maps -->
        <div class="row align-items-center service-row">
            <div class="col-md-6 text-center">
                <a href="https://maps.app.goo.gl/k62WSxRbDu5ewsd97" target="_blank">
                    <img src="{{ asset('img/peta.jpg') }}" class="w-75 img-custom" title="Klik untuk lihat lokasi di Google Maps">
                </a>
            </div>
            <div class="col-md-6">
                <div class="text-card">
                    <p class="my-text-color" style="font-size: 19px;">
                        Kecamatan Panyabungan Kota merupakan wilayah administratif yang menjadi pusat kegiatan 
                        pemerintahan, ekonomi, dan sosial di Kabupaten Mandailing Natal. Lokasi ini juga menjadi 
                        salah satu daerah yang mendapatkan perhatian khusus dalam implementasi Program Keluarga Harapan (PKH).
                    </p>
                    <p class="my-text-color" style="font-size: 19px;">
                        Melalui visualisasi peta ini, masyarakat dapat lebih mudah mengenal cakupan wilayah 
                        Panyabungan Kota, sekaligus mengakses informasi lokasi secara langsung melalui Google Maps. 
                        Klik gambar peta untuk mengetahui titik koordinat dan detail wilayah kecamatan ini.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="row align-items-center flex-md-row-reverse service-row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('img/pkh5.jpg') }}" class="w-75 img-custom" title="Grafik Kemiskinan">
            </div>
            <div class="col-md-6">
                <div class="text-card">
                    <p class="my-text-color" style="font-size: 19px;">
                        Grafik kemiskinan ini menunjukkan tren jumlah keluarga prasejahtera di Kecamatan Panyabungan Kota. 
                        Data visual ini menggambarkan kondisi sosial ekonomi masyarakat dari tahun ke tahun, sehingga dapat 
                        menjadi acuan dalam menentukan prioritas kebijakan.
                    </p>
                    <p class="my-text-color" style="font-size: 19px;">
                        Melalui grafik, terlihat jelas bagaimana intervensi program bantuan sosial termasuk PKH 
                        berkontribusi dalam menurunkan angka kemiskinan. Animasi data juga dapat digunakan untuk menampilkan 
                        perkembangan dari waktu ke waktu agar lebih mudah dipahami.
                    </p>
                </div>
            </div>
        </div>

        <!-- Bagian 2: Foto keluarga penerima -->
        <div class="row align-items-center service-row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('img/pkh1.jpg') }}" class="w-75 img-custom">
            </div>
            <div class="col-md-6">
                <div class="text-card">
                    <p class="my-text-color" style="font-size: 19px;">
                        Keluarga penerima manfaat PKH merupakan sasaran utama yang mendapatkan bantuan dalam bentuk 
                        transfer non-tunai. Bantuan ini diberikan agar keluarga dapat memenuhi kebutuhan dasar 
                        seperti biaya pendidikan anak, pemeriksaan kesehatan ibu hamil dan balita, serta pemenuhan 
                        gizi yang seimbang.
                    </p>
                    <p class="my-text-color" style="font-size: 19px;">
                        Melalui program ini, setiap keluarga didorong untuk lebih memperhatikan masa depan anak-anaknya 
                        dengan tetap bersekolah, serta menjaga kesehatan keluarga dengan rutin memeriksakan diri di 
                        fasilitas kesehatan. Hal ini diharapkan dapat memutus rantai kemiskinan antar generasi.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Bagian 1: Logo PKH -->
        <div class="row align-items-center flex-md-row-reverse service-row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('img/pkh.jpg') }}" class="w-75 img-custom">
            </div>
            <div class="col-md-6">
                <div class="text-card">
                    <p class="my-text-color" style="font-size: 19px;">
                        Program Keluarga Harapan (PKH) merupakan salah satu program prioritas pemerintah dalam rangka 
                        pengentasan kemiskinan. Logo PKH bukan sekadar lambang, tetapi simbol dari tekad bersama 
                        untuk meningkatkan kualitas hidup masyarakat kurang mampu melalui intervensi di bidang 
                        pendidikan, kesehatan, dan kesejahteraan sosial.
                    </p>
                    <p class="my-text-color" style="font-size: 19px;">
                        Dengan adanya PKH, diharapkan tercipta generasi yang lebih sehat, cerdas, dan mampu mandiri. 
                        Program ini juga menjadi bentuk nyata kehadiran negara dalam membantu rakyatnya, terutama 
                        mereka yang masih berada di garis kemiskinan.
                    </p>
                </div>
            </div>
        </div>
        

    </div>
</div>
