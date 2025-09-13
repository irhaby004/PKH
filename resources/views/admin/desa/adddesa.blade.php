@extends('layouts.my_admin_layout')
@section('title', 'Nama Desa')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Tambah Desa</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('desa.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_desa_calon" class="form-label fw-bold my-text-color">Nama Desa</label>
                                <input type="text" class="form-control @error('nama_desa_calon') is-invalid @enderror"
                                    id="nama_desa_calon" value="{{ old('nama_desa_calon') }}" name="nama_desa_calon">
                                @error('nama_desa_calon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn my-bg text-white p-2 px-4"><i class="fa fa-save fa-fw"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')

@endsection
