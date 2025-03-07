@extends('layout.mainlayout')
@section('title', 'Laporan Konseling Disetujui')

@section('content')
    @component('components.breadcrumb')
        @slot('title') Laporan Konseling Disetujui @endslot
        @slot('li_1') 
            @slot('link') {{ route('mgt.counseling.approved') }} @endslot
            Konseling
        @endslot
        @slot('li_2') Laporan Disetujui @endslot
    @endcomponent

    <style>
        .form-control {
            margin-bottom: 5px;
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

    <form method="GET" action="{{ route('mgt.counseling.approved') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" value="{{ request('nis') }}" placeholder="Cari berdasarkan NIS">
            </div>
            <div class="col-md-4">
                <label for="major_id" class="form-label">Kelas</label>
                <select name="major_id" id="major_id" class="form-control js-example-basic-single">
                    <option value="">Semua Kelas</option>
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}" {{ request('major_id') == $major->id ? 'selected' : '' }}>
                            {{ $major->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="teacher_id" class="form-label">Guru BK</label>
                <select name="teacher_id" id="teacher_id" class="form-control js-example-basic-single">
                    <option value="">Semua Guru</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" class="form-control" 
                    value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" class="form-control" 
                    value="{{ request('end_date') }}">
            </div>
        </div>

        <div class="row mt-3">
            <!-- Tombol Aksi -->
            <div class="col-md-12 d-flex">
                <button type="submit" class="btn btn-primary me-2"><i class="fa fa-search me-1"></i> Search</button>
                <a href="{{ route('mgt.counseling.approved') }}" class="btn btn-secondary me-2"><i class="fa fa-refresh me-1"></i> Reset</a>
                <a href="{{ route('mgt.counseling.downloadApproved', request()->all()) }}" class="btn btn-success"><i class="fa fa-download me-1"></i> Download Excel</a>
            </div>
        </div>
    </form>


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
                            <th>Guru BK</th>
                            <th>Tanggal Konseling</th>
                            <th>Deskripsi</th>
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
                                <td>{{ $report->teacher->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->date)->format('d M Y') }}</td>
                                <td>{{ $report->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
