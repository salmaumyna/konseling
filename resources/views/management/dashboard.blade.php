@extends('layout.mainlayout')

@section('title', 'Beranda')

@section('content')
    @component('components.breadcrumb')
        @slot('title')
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Beranda
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.dashboard.index') }}
            @endslot
            Management
        @endslot
        @slot('li_2')
            Beranda
        @endslot
    @endcomponent

    <x-alert/>
    <form action="{{ route('mgt.dashboard.index') }}" method="GET">
        <div class="row">
            <div class="col-md-4">
                <label for="year">Tahun</label>
                <select id="year" name="year" class="form-control">
                    @for ($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-4">Tampilkan</button>
            </div>
        </div>
    </form>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="counselingChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const approved = @json($approved);

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Disetujui',
                    data: approved,
                    backgroundColor: 'rgba(40, 167, 69, 0.5)',
                    borderColor: 'rgb(40, 167, 69)',
                    borderWidth: 2,
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {position: 'top'},
                        title: {
                            display: true,
                            text: 'Grafik Konseling Siswa {{ $year }}',
                            font: {size: 18}
                        }
                    },
                    scales: {y: {beginAtZero: true, ticks: {precision: 0}}}
                }
            };

            const ctx = document.getElementById('counselingChart');
            if (ctx) {
                new Chart(ctx, config);
            } else {
                console.error("Canvas ID 'counselingChart' tidak ditemukan!");
            }
        });
    </script>
@endsection

@push('scripts')
@endpush