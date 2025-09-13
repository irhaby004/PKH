@extends('layouts.my_layout')
@section('title', 'Rekomendasi')
@section('content')
    <style>
        /* Background gradient 3D feel */
        .bg-3d {
            background: linear-gradient(135deg, #e0f7fa, #e3f2fd, #ede7f6);
            min-height: 100vh;
        }

        /* 3D Card */
        .card-3d {
            background: #fff;
            border-radius: 1.2rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15), 
                        0 10px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-3d:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
        }

        /* Table header 3D */
        thead tr {
            background: linear-gradient(135deg, #2196f3, #00bcd4);
            color: #fff !important;
            font-weight: 600;
        }

        /* Table row hover 3D */
        tbody tr {
            transition: all 0.3s ease;
        }
        tbody tr:hover {
            transform: translateX(6px);
            background: rgba(0, 188, 212, 0.08);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* 3D Badges */
        .badge-3d {
            border-radius: 30px;
            padding: 0.55rem 1.2rem;
            font-weight: 600;
            font-size: 0.85rem;
            box-shadow: inset 0 2px 4px rgba(255, 255, 255, 0.6),
                        0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .badge-green {
            background: linear-gradient(135deg, #4caf50, #81c784);
            color: #fff;
        }

        .badge-red {
            background: linear-gradient(135deg, #e53935, #ef5350);
            color: #fff;
        }

        .badge-blue {
            background: linear-gradient(135deg, #2196f3, #64b5f6);
            color: #fff;
        }
    </style>

    <div class="bg-3d d-flex align-items-center py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-5 text-dark">
                <i class="bi bi-bar-chart-fill text-primary"></i> Hasil Klasifikasi PKH (SVM)
            </h2>

            <div class="card-3d p-4">
                <h4 class="fw-bold text-dark mb-4">
                    <i class="bi bi-table"></i> Hasil
                </h4>
                <div class="table-responsive">
                    <table id="datatable" class="table align-middle text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kriteria</th>
                                <th>Nilai Input</th>
                                <th>Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($datasets as $index => $d)
                                @foreach ($d->details as $detail)
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ $d->details->count() }}" class="fw-bold">
                                                {{ $loop->parent->iteration }}
                                            </td>
                                            <td rowspan="{{ $d->details->count() }}" class="fw-semibold text-primary">
                                                <i class="bi bi-person-bounding-box"></i> {{ $d->nama }}
                                            </td>
                                        @endif
                                        <td>{{ $detail->kriteria->nama_kriteria }}</td>
                                        <td>
                                            <span class="badge-3d badge-blue">
                                                {{ $detail->status }}
                                            </span>
                                        </td>
                                        @if ($loop->first)
                                            <td rowspan="{{ $d->details->count() }}">
                                                @if ($d->roc == 'Layak')
                                                    <span class="badge-3d badge-green">
                                                        <i class="bi bi-check-circle-fill"></i> {{ $d->roc }}
                                                    </span>
                                                @else
                                                    <span class="badge-3d badge-red">
                                                        <i class="bi bi-x-circle-fill"></i> {{ $d->roc }}
                                                    </span>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="5" class="text-muted py-4">
                                        <i class="bi bi-exclamation-circle"></i> Tidak ada data tersedia
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
