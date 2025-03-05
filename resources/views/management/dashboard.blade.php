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

<style>
    label {
        margin-bottom: 10px;
    }
</style>

<x-alert />
<div class="row">
    <div class="col-md-4 d-flex align-items-center">
        <label for="year" class="me-3">Tahun :</label>
        <select id="year" name="year" class="form-control js-example-basic-multiple w-50">
            @for ($i = date('Y'); $i >= 2020; $i--)
                <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>
</div>

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
        const approved = @json($approved); // Ambil data dari Blade

        console.log("Data Approved:", approved); // Debugging: lihat data di console browser

        // Mendapatkan konteks canvas
        const ctx = document.getElementById('counselingChart').getContext('2d');

        // Membuat gradient untuk efek warna yang lebih menarik
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(40, 167, 69, 0.8)');
        gradient.addColorStop(1, 'rgba(40, 167, 69, 0.3)');

        const data = {
            labels: labels,
            datasets: [{
                label: 'Disetujui',
                data: approved,
                backgroundColor: gradient,
                borderColor: 'rgb(40, 167, 69)',
                borderWidth: 2,
                borderRadius: 8, // Membuat sudut bar lebih melengkung
                hoverBackgroundColor: 'rgba(40, 167, 69, 1)', // Warna saat dihover
                hoverBorderColor: 'rgb(30, 140, 60)', // Border saat dihover
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
                            font: { size: 14, weight: 'bold', fontfamily: 'Nunito' },
                            color: '#333'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Grafik Konseling Siswa ' + '{{ $year }}',
                        font: { size: 20, fontfamily: 'Nunito', weight: 'bold' },
                        color: '#222'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14, fontfamily: 'Nunito', weight: 'bold' },
                        bodyFont: { size: 12 },
                        bodySpacing: 6,
                        padding: 10,
                        cornerRadius: 6,
                        boxShadow: '2px 2px 10px rgba(0,0,0,0.2)', // Efek bayangan tooltip
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 12, fontfamily: 'Nunito' }, color: '#444' }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: { size: 12 },
                            color: '#444'
                        },
                        grid: { color: 'rgba(200, 200, 200, 0.2)' } // Grid lebih soft
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce'
                }
            }
        };

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