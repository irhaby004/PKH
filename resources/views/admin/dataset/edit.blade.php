@extends('layouts.my_admin_layout')
@section('title', 'Edit Dataset')
@section('content')
<main class="content">
    <div class="container p-0">
        <h1 class="mb-3 fw-bold text-primary">Edit Data Dataset</h1>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <form action="{{ route('dataset.update', [$dataset->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="nama" class="form-label fw-bold text-primary">Nama Desa</label>
                            <input type="text" 
                                   class="form-control custom-input @error('nama') is-invalid @enderror"
                                   id="nama" 
                                   name="nama"
                                   value="{{ old('nama', $dataset->nama) }}" 
                                   placeholder="Masukkan Nama Desa">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary mb-3">Kriteria</h5>
                    <div class="row">
                        @foreach ($dataset->details as $detail)
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-primary">
                                    {{ $detail->kriteria->nama_kriteria }}
                                </label>
                                <input type="number" step="any"
                                       class="form-control custom-input @error('kriteria_' . $detail->kriteria->id) is-invalid @enderror"
                                       name="{{ 'kriteria_' . $detail->kriteria->id }}"
                                       value="{{ old('kriteria_' . $detail->kriteria->id, $detail->status) }}"
                                       placeholder="Masukkan {{ strtolower($detail->kriteria->nama_kriteria) }}">
                                @error('kriteria_' . $detail->kriteria->id)
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary shadow-sm rounded-pill px-4 py-2 fw-bold">
                            <i class="fa fa-save fa-fw me-1"></i> Simpan
                        </button>
                        <a href="{{ route('dataset.index') }}" class="btn btn-outline-secondary rounded-pill ms-3 px-4 py-2 fw-bold">
                            <i class="fa fa-arrow-left fa-fw me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
    .custom-input {
        border-radius: 10px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .custom-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.4);
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #004099);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 91, 187, 0.4);
    }

    .btn-outline-secondary:hover {
        background: #f1f1f1;
    }
</style>
@endpush
