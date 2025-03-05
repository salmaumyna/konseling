@extends('layout.mainlayout')
@section('title', 'Laporan Konseling')

@section('content')
    @component('components.breadcrumb')
        @slot('title') Laporan Konseling @endslot
        @slot('li_1') 
            @slot('link') {{ route('mgt.counseling.index') }} @endslot
            Konseling
        @endslot
        @slot('li_2') Laporan @endslot
    @endcomponent

    <style>
    .form-control {
        height: 38px; 
    }
    label {
        font-size: 14px;
    }

    .badge {
        padding: 8px 12px;
        border-radius: 4px;
        font-weight: bold;
    }

    .bg-success {
        background: #C8E4B2 !important;
        color: black;
        border: none;
    }

    .bg-warning {
        background: #FFF8A6 !important;
        color: black;
        border: none;
    }

    .bg-danger {
        background: #FF9F9F !important;
        color: black;
        border: none;
    }
    
    @media (max-width: 480px){
        .page-title {
            font-size: 15px;
        }
        .form-label {
            margin-bottom: 10px;
            font-size: 12px;
        }
        .form-control {
            margin-bottom: 10px;
        }
        .btn {
            margin: 5px;
            padding: 10px !important;
        }
        i {
            font-size : 14px !important;
        }
    }
    </style>

    <x-alert />

    <form method="GET" action="{{ route('mgt.counseling.index') }}" class="mb-3">
        <div class="row align-items-center">
            <div class="col-md-1">
                <label for="nis" class="form-label">NIS:</label>
            </div>
            <div class="col-md-4">
                <input type="text" name="nis" id="nis" class="form-control" value="{{ request('nis') }}" placeholder="Cari berdasarkan NIS">
            </div>
            <div class="col-md-1">
                <label for="status" class="form-label">Status:</label>
            </div>
            <div class="col-md-4">
                <select name="status" id="status" class="js-example-basic-single form-control">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 d-flex">
                <button type="submit" class="btn btn-primary me-2"><i class="fa fa-search me-1"></i> Search</button>
                <a href="{{ route('mgt.counseling.index') }}" class="btn btn-secondary me-2"><i class="fa fa-refresh me-1"></i> Reset</a>
                <button type="submit" name="action" value="download" class="btn btn-success"><i class="fa fa-download me-1"></i> Download Excel</button> 
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Tingkat</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Konseling</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($counselingReports as $report)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $report->student->nis }}</td>
                                        <td>{{ $report->student->nama }}</td>
                                        <td>{{ $report->class->name ?? '-' }}</td>
                                        <td>{{ $report->major->name ?? '-' }}</td>
                                        <td>{{ $report->date }}</td>
                                        <td>{{ $report->description }}</td>
                                        <td>
                                            @if ($report->status === 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif ($report->status === 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('mgt.counseling.detail', $report->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                            @if(auth()->user()->role === 'admin')
                                                <form action="{{ route('mgt.counseling.updateStatus', $report->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm">Perbarui Status</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
