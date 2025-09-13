@extends('layouts.my_admin_layout')
@section('title', 'Bobot')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Bobot</h1>
            <div class="card">
                <div class="card-body">
                    {{-- <div class="d-flex mb-4 justify-content-end gap-2">
                        <a href="{{ route('bobot.create') }}" class="btn my-bg text-white p-2 px-4">
                            <i class="fa fa-plus fa-fw"></i>
                            Tambah Bobot
                        </a>
                        <form action="{{ route('bobot.reset_bobot') }}" class="d-inline-block reset-btn" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger p-2 px-4"><i class="fa fa-refresh fa-fw"></i> Reset
                                Bobot</button>
                        </form>
                    </div> --}}
                    @include('components.flash-message')
                    <table id="datatable" class="table table-bordered rounded w-100">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Bobot</th>
                                <th class="text-center">Bobot</th>
                                {{-- <th class="text-center"><i class="fa fa-cogs"></i></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Kriterias as $kriteria)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $kriteria->nama_kriteria }}</td>
                                    <td class="text-center">{{ $kriteria->roc }}</td>
                                    {{-- <td class="text-center text-nowrap">
                                        <a href="{{ route('bobot.edit', [$bobot->id]) }}" class="btn my-bg text-white"><i
                                                class="fa fa-edit"></i></a>
                                        <form action="{{ route('bobot.destroy', [$bobot->id]) }}"
                                            class="d-inline-block delete-btn" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#datatable', );

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

            const resetBtn = document.querySelector('.reset-btn')
            if (resetBtn) {
                resetBtn.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Ingin mereset bobot",
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
