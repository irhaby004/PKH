@extends('layouts.my_admin_layout')
@section('title', 'Kriteria')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Edit Kriteria</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kriteria.update', [$kriteria->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_kriteria" class="form-label fw-bold my-text-color">Kriteria</label>
                                <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror"
                                    id="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}"
                                    name="nama_kriteria">
                                @error('nama_kriteria')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="peringkat" class="form-label fw-bold my-text-color">Peringkat</label>
                                <input type="text" class="form-control @error('peringkat') is-invalid @enderror"
                                    id="peringkat" value="{{ old('peringkat', $kriteria->peringkat) }}" name="peringkat">
                                @error('peringkat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="min" class="form-label fw-bold my-text-color">Nilai Minimum</label>
                                <input type="number" class="form-control @error('min') is-invalid @enderror"
                                    id="min" value="{{ old('min', $kriteria->min) }}" name="min">
                                @error('min')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="max" class="form-label fw-bold my-text-color">Nilai Maksimum</label>
                                <input type="number" class="form-control @error('max') is-invalid @enderror"
                                    id="max" value="{{ old('max', $kriteria->max) }}" name="max">
                                @error('max')
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
