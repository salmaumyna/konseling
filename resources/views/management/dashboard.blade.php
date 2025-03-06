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
            <div class="col-md-4 d-flex align-items-center">
                <label for="year" class="me-2">Tahun</label>
                <select id="year" name="year" class="form-control js-example-basic-multiple">
                    @for ($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
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

            const ctx = document.getElementById('counselingChart').getContext('2d');
            if (!ctx) {
                console.error("Canvas ID 'counselingChart' tidak ditemukan!");
                return;
            }

            // Membuat gradient untuk batang grafik
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(40, 167, 69, 0.8)'); // Hijau lebih terang di atas
            gradient.addColorStop(1, 'rgba(40, 167, 69, 0.3)'); // Lebih transparan di bawah

            const data = {
                labels: labels,
                datasets: [{
                    label: 'Disetujui',
                    data: approved,
                    backgroundColor: gradient,
                    borderColor: 'rgb(40, 167, 69)',
                    borderWidth: 2,
                    borderRadius: 15, // Membuat sudut batang lebih halus
                    hoverBackgroundColor: 'rgba(30, 140, 60, 0.8)', // Efek hover lebih gelap
                    hoverBorderColor: 'rgb(30, 140, 60)',
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {size: 14},
                                color: '#444'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Grafik Konseling Siswa {{ $year }}',
                            font: {size: 20, weight: 'bold'},
                            color: '#222'
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.7)',
                            titleFont: {size: 14, weight: 'bold'},
                            bodyFont: {size: 13},
                            padding: 10,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {precision: 0, font: {size: 12}, color: '#555'}
                        },
                        x: {
                            ticks: {font: {size: 12}, color: '#555'}
                        }
                    },
                    animation: {
                        duration: 1200, // Animasi lebih smooth
                        easing: 'easeInOutQuart'
                    }
                }
            };

            new Chart(ctx, config);
        });
    </script>

@endsection

@push('scripts')
@endpush