@extends('layout.mainlayout')
@section('title', 'Laporan Konseling Disetujui')

@section('content')
    @component('components.breadcrumb')
        @slot('title') Laporan Konseling Disetujui @endslot
        @slot('li_1') 
            @slot('link') {{ route('mgt.counseling.index') }} @endslot
            Konseling
        @endslot
        @slot('li_2') Laporan Disetujui @endslot
    @endcomponent

    <x-alert />

    <form method="GET" action="{{ route('mgt.counseling.approved') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" name="nis" id="nis" class="form-control" value="{{ request('nis') }}" placeholder="Cari berdasarkan NIS">
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('mgt.counseling.approved') }}" class="btn btn-secondary me-2">Reset</a>
                    <a href="{{ route('mgt.counseling.downloadApproved', request()->all()) }}" class="btn btn-success">Download Excel</a>
                </div>
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
                                        <td>{{ $report->date }}</td>
                                        <td>{{ $report->description }}</td>
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
