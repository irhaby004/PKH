@extends('layouts.my_admin_layout')
@section('title', 'kriteria')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Kriteria</h1>
            <div class="card shadow-3d rounded-4 border-0">
                <div class="card-body">
                    <div class="d-flex mb-4 justify-content-end gap-2">
                        <!-- tombol bisa diaktifkan kalau perlu -->
                    </div>
                    @include('components.flash-message')
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover align-middle rounded-3 shadow-sm overflow-hidden">
                            <thead class="my-bg-gradient text-white">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Kriteria</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriterias as $kriteria)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $kriteria->nama_kriteria }}</td>
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

            const deleleBtn = document.querySelectorAll('.delete-btn')
            deleleBtn.forEach(el => {
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
        })
    </script>
@endsection

<style>
    /* efek card 3D */
    .shadow-3d {
        box-shadow: 0 6px 12px rgba(0,0,0,0.15),
                    0 12px 24px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .shadow-3d:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0,0,0,0.25),
                    0 20px 40px rgba(0,0,0,0.2);
    }

    /* gradient biru tosca */
    .my-bg-gradient {
        background: linear-gradient(135deg, #007bff, #20c997);
    }

    /* hover baris tabel */
    table tbody tr:hover {
        background-color: #f5f9ff !important;
        transform: scale(1.01);
        transition: 0.2s ease-in-out;
    }
    .my-text-color {
        background: linear-gradient(135deg, #007BFF, #20C997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
