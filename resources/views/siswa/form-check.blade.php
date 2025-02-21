@extends('layout.plain')

@section('title', 'Status Konseling')

@section('content')

<style>
    body {
    background: #F5EFFF;
    font-family: 'Arial', sans-serif;
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
    background: #5a6268;
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
    max-width: 900px;
    margin: 40px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.table thead {
    background: #17a2b8;
    color: white;
}

.table th, .table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
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
    background: #28a745;
    color: white;
}

.badge-warning {
    background: #ffc107;
    color: black;
}

.badge-danger {
    background: #dc3545;
    color: white;
}

@media (max-width: 600px) {
    .form-card {
        width: 90%;
    }
}

</style>

<x-alert />

<div class="container mt-4">
    <h4 class="text-center">Status Pengajuan Konseling</h4>
    <p class="text-center">NIS: <strong>{{ $student->nis }}</strong> | Nama: <strong>{{ $student->nama }}</strong></p>

    @if(isset($student))
    <h4>Hasil Pengecekan untuk: <strong>{{ $student->nama }}</strong> ({{ $student->nis }})</h4>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Guru BK</th>
            <th>Keterangan</th>
            <th>reason</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($counseling_reports as $report)
            <tr>
                <td>{{ $report->date }}</td>
                <td>{{ $report->teacher->name }}</td>
                <td>{{ $report->description }}</td>
                <td> {{ $report->reason }}</td>
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
                <td colspan="4" class="text-center">Belum ada pengajuan konseling</td>
            </tr>
        @endforelse
    </tbody>
</table>
   

    <a href="{{ route('counseling.status.form') }}" class="btn btn-secondary mt-3">Cek NIS Lain</a>
</div>

@endsection
