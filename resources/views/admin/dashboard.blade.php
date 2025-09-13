@extends('layouts.my_admin_layout')
@section('title', 'Dashboard')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="mb-4 fw-bold my-text-color">
            Selamat Datang Di Sistem Klasifikasi Penerima Bantuan Program Keluarga Harapan dengan Algoritma SVM di beberapa Desa di Kecamatan Panyabungan Kota
        </h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card dashboard-card shadow-3d">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title my-text-color">Jumlah Dataset</h5>
                                <h1 class="mt-1 mb-0 fw-bold">{{ $dataset }}</h1>
                            </div>
                            <div class="col-auto">
                                <div class="icon-box">
                                    <i class="fa fa-database align-middle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<style>
    .dashboard-card {
        border-radius: 20px;
        background: #fff;
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .shadow-3d {
        box-shadow: 0 6px 12px rgba(0,0,0,0.15), 
                    0 12px 24px rgba(0,0,0,0.1);
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.25),
                    0 20px 40px rgba(0,0,0,0.2);
    }

    .icon-box {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #00bcd4, #0097a7);
        color: #fff;
        font-size: 28px;
        box-shadow: inset 0 2px 6px rgba(255,255,255,0.3),
                    0 4px 10px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
    }

    .dashboard-card:hover .icon-box {
        transform: rotate(8deg) scale(1.1);
    }
    .my-text-color {
        background: linear-gradient(135deg, #007BFF, #20C997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection
