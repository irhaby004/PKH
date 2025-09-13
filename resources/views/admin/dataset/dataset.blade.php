@extends('layouts.my_admin_layout')
@section('title', 'Dataset')
@section('content')
<main class="content">
    <div class="container p-0">
        <h1 class="mb-3 fw-bold my-text-color">Data</h1>
        <div class="card shadow-3d rounded-4 border-0">
            <div class="card-body">
                <div class="d-flex mb-4 justify-content-end gap-2">
                    <a href="{{ route('dataset.create') }}" class="btn my-bg text-white p-2 px-4 rounded-pill shadow-sm">
                        <i class="fa fa-plus fa-fw"></i>
                        Tambah Data
                    </a>
                    @can('resetDataset', App\Models\Dataset::class)
                        <form action="{{ route('dataset.reset_dataset') }}" class="d-inline-block reset-btn" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger p-2 px-4 rounded-pill shadow-sm">
                                <i class="fa fa-refresh fa-fw"></i> Reset Dataset
                            </button>
                        </form>
                    @endcan
                </div>

                @include('components.flash-message')

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover align-middle rounded-3 shadow-sm overflow-hidden">
                        <thead class="my-bg text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Inisial</th>
                                @foreach ($kriteria as $k)
                                    <th class="text-center">{{ $k->nama_kriteria }}</th>
                                @endforeach
                                <th class="text-center">Termasuk Lansia</th>
                                @can('view-admin-settings')
                                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datasets as $dataset)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $dataset->nama }}</td>
                                    @foreach ($dataset->details as $d)
                                        <td class="text-center">{{ number_format($d->status, 0, ',', '.') }}</td>
                                    @endforeach
                                    <td class="text-center">
                                        @php
                                            $isLansia = false;
                                            foreach ($dataset->details as $detail) {
                                                if ($detail->kriteria->nama_kriteria === 'umur' && $detail->status >= 60) {
                                                    $isLansia = true;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <span class="badge {{ $isLansia ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $isLansia ? 'Lansia' : 'Bukan Lansia' }}
                                        </span>
                                    </td>
                                    @can('view-admin-settings')
                                        <td class="text-center text-nowrap">
                                            <a href="{{ route('dataset.edit', [$dataset->id]) }}" class="btn my-bg text-white btn-sm rounded-pill shadow-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dataset.destroy', [$dataset->id]) }}" class="d-inline-block delete-btn" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill shadow-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        new DataTable('#datatable', {
            "columnDefs": [{
                "orderable": false,
                "targets": -1
            }]
        });

        const deleteBtn = document.querySelectorAll('.delete-btn')
        deleteBtn.forEach(el => {
            el.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Ingin menghapus data ini",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit()
                    }
                })
            })
        })

        const resetBtn = document.querySelector('.reset-btn')
        if (resetBtn) {
            resetBtn.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Ingin mereset dataset",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Reset',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit()
                    }
                })
            })
        }
    })
</script>
@endsection

<style>
    /* .shadow-3d {
        box-shadow: 0 6px 12px rgba(0,0,0,0.15), 
                    0 12px 24px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .shadow-3d:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.25),
                    0 20px 40px rgba(0,0,0,0.2);
    }
    table tbody tr:hover {
        background-color: #f5f9ff !important;
        transform: scale(1.01);
        transition: 0.2s ease-in-out;
    } */
     /* Warna utama gradient biru tosca */
    .my-bg {
        background: linear-gradient(135deg, #007BFF, #20C997);
    }

    .my-text-color {
        background: linear-gradient(135deg, #007BFF, #20C997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Card 3D dengan efek modern */
    .shadow-3d {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15), 
                    0 12px 24px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
    }

    .shadow-3d:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.2),
                    0 25px 50px rgba(0,0,0,0.15);
    }

    /* Table row hover efek */
    table tbody tr:hover {
        background: linear-gradient(135deg, #e3f2fd, #d1f7f0) !important;
        transform: scale(1.01);
        transition: 0.25s ease-in-out;
    }

    /* Tombol agar match dengan gradient */
    .btn.my-bg {
        background: linear-gradient(135deg, #007BFF, #20C997);
        border: none;
        transition: 0.3s ease-in-out;
    }

    .btn.my-bg:hover {
        background: linear-gradient(135deg, #0056b3, #17a589);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
    }
</style>
