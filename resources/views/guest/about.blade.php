@extends('layouts.my_layout')

@section('title', 'About - Data Excel')

@section('content')
<div class="container py-5">
    <h1 class="text-center">Data Import dan Pelatihan</h1>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">Semua Data</button>
            <button class="nav-link" id="nav-train-tab" data-bs-toggle="tab" data-bs-target="#nav-train" type="button" role="tab" aria-controls="nav-train" aria-selected="false">Data Latih</button>
            <!-- <button class="nav-link" id="nav-training-tab" data-bs-toggle="tab" data-bs-target="#nav-training" type="button" role="tab" aria-controls="nav-training" aria-selected="false">Hasil Pelatihan</button> -->
            <button class="nav-link" id="nav-hyperplane-tab" data-bs-toggle="tab" data-bs-target="#nav-hyperplane" type="button" role="tab" aria-controls="nav-hyperplane" aria-selected="false">Hyperplane & F1 Score</button>
        </div>
    </nav>

    <div class="tab-content mt-4" id="nav-tabContent">
        <!-- Semua Data -->
        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
            <h3 class="text-center">Semua Data</h3>
            @if ($datasets->isEmpty())
                <p class="text-center">Tidak ada data yang tersedia.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Gaji</th>
                            <th>Umur</th>
                            <th>Jumlah Anak</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datasets as $index => $dataset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dataset['nama'] }}</td>
                                <td>{{ $dataset['gaji'] }}</td>
                                <td>{{ $dataset['umur'] }}</td>
                                <td>{{ $dataset['jumlah_anak'] }}</td>
                                <td>{{ $dataset['hasil'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Data Latih -->
        <div class="tab-pane fade" id="nav-train" role="tabpanel" aria-labelledby="nav-train-tab">
            <h3 class="text-center">Data Latih</h3>
            @if ($trainDatasets->isEmpty())
                <p class="text-center">Tidak ada data latih yang tersedia.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Gaji</th>
                            <th>Umur</th>
                            <th>Jumlah Anak</th>
                            <th>Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainDatasets as $index => $dataset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dataset['nama'] }}</td>
                                <td>{{ $dataset['gaji'] }}</td>
                                <td>{{ $dataset['umur'] }}</td>
                                <td>{{ $dataset['jumlah_anak'] }}</td>
                                <td>{{ $dataset['hasil'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Hyperplane & F1 Score -->
        <div class="tab-pane fade" id="nav-hyperplane" role="tabpanel" aria-labelledby="nav-hyperplane-tab">
            <h3 class="text-center">Hyperplane dan F1 Score</h3>
            <canvas id="hyperplaneChart" width="400" height="400"></canvas>
            <h5 class="mt-4">F1 Score</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Precision</th>
                        <th>Recall</th>
                        <th>F1-Score</th>
                        <th>Support</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Layak</td>
                        <td>{{ number_format($precision['layak'], 2) }}</td>
                        <td>{{ number_format($recall['layak'], 2) }}</td>
                        <td>{{ number_format($f1Score['layak'], 2) }}</td>
                        <td>{{ $support['layak'] }}</td>
                    </tr>
                    <tr>
                        <td>Tidak Layak</td>
                        <td>{{ number_format($precision['tidak_layak'], 2) }}</td>
                        <td>{{ number_format($recall['tidak_layak'], 2) }}</td>
                        <td>{{ number_format($f1Score['tidak_layak'], 2) }}</td>
                        <td>{{ $support['tidak_layak'] }}</td>
                    </tr>
                </tbody>
            </table>

            <h5>Confusion Matrix</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Predicted: Layak</th>
                        <th>Predicted: Tidak Layak</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Actual: Layak</td>
                        <td>{{ $confusionMatrix['TP'] }}</td>
                        <td>{{ $confusionMatrix['FN'] }}</td>
                    </tr>
                    <tr>
                        <td>Actual: Tidak Layak</td>
                        <td>{{ $confusionMatrix['FP'] }}</td>
                        <td>{{ $confusionMatrix['TN'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambahkan Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('hyperplaneChart').getContext('2d');
    const hyperplaneChart = new Chart(ctx, {
        type: 'scatter',
        data: {
            datasets: [
                {
                    label: 'Hyperplane',
                    data: [
                        { x: -10, y: {{ $weights[0] * -10 + $bias }} },
                        { x: 10, y: {{ $weights[0] * 10 + $bias }} },
                    ],
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 2,
                },
            ],
        },
        options: {
            scales: {
                x: { type: 'linear', position: 'bottom' },
                y: { type: 'linear' },
            },
        },
    });
</script>
@endsection
