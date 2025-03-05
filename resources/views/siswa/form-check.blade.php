@extends('layout.plain')

@section('title', 'Status Konseling')

@section('content')

@include('layout.partials.head')
@stack('styles')

<style>
    body {
        background: url('/assets/img/bg-nis.png') no-repeat center center fixed;
        background-size: cover;
    }

.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.form-card {
    width: 380px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 20px;
    transition: 0.3s;
}

.form-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.form-header {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
}

.form-body label {
    font-weight: 600;
    color: #444;
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    max-width: 355px;
    padding: 8px;
    margin-bottom: 8px;
    border: 2px solid #ced4da;
    border-radius: 6px;
    font-size: 14px;
    transition: 0.3s;
}

.form-control:focus {
    border-color: #17a2b8;
    outline: none;
    box-shadow: 0px 0px 5px rgba(23, 162, 184, 0.5);
}

.invalid-feedback {
    color: red;
    font-size: 13px;
    margin-top: 5px;
}

.form-footer {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 15px;
}

.btn {
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}

.btn-secondary {
    margin-right: 10px;
    background: #B4B4B8;
    color: white;
}

.btn-secondary:hover {
    background: #BFA2DB;
}

.btn-info {
    background: #17a2b8;
    color: white;
}

.btn-info:hover {
    background: #138496;
}

.text-danger {
    color: #BB5A5A;
    font-size: 13px;
    font-weight: bold;
}

/* Table Styling for Status Konseling */
.container {
    background: white;
    padding: 2px 15px 1px 15px;
    margin-top: 30px;
    margin-bottom: 35px;
    border-radius: 10px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    margin-bottom: 20px;
}

.table thead {
    color: white;
}
.table th {
    background: #B08BBB !important;
}
.table th, .table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd !important;
}

.table tbody tr:hover {
    background: #f1f1f1;
}

.badge {
    padding: 5px 10px;
    border-radius: 4px;
    font-weight: bold;
}

.badge-success {
    background: #C8E4B2;
    color: black;
    border: none;
}

.badge-warning {
    background: #FFF8A6;
    color: black;
    border: none;
}

.badge-danger {
    background: #FF9F9F;
    color: black;
    border: none;
}

@media (max-width: 600px) {
    .form-card {
        width: 90%;
    }
}

@media (max-width: 480px) {
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Agar smooth saat di-scroll */
    }

    .table {
        width: 100%;
        min-width: 600px; /* Mencegah kolom terlalu kecil */
    }

    h3{
        font-size: 22px;
    }
}


@media (max-width: 1200px) {
    .container {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
}

</style>

<x-alert />

<div class="container">
        <h3 class="text-center mb-4">Status Pengajuan Konseling</h3>
        <p class="text-start">Nama: <strong>{{ $student->nama }} </strong> <br> NIS: <strong>{{ $student->nis }}</strong></p>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Guru BK</th>
                        <th>Keterangan</th>
                        <th>Alasan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($counseling_reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->date }}</td>
                            <td>{{ $report->teacher->name }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->reason ? $report->reason : '-' }}</td>
                            <td>
                                @if($report->status == 'approved')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif($report->status == 'pending')
                                    <span class="badge badge-warning">Menunggu</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada pengajuan konseling</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <a href="{{ route('index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>

    @include('layout.partials.footer-scripts')
    @stack('scripts')
@endsection