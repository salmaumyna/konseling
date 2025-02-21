@extends('layout.mainlayout')
@section('title', 'Laporan Konseling')

@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Laporan Konseling
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('Mgt.counseling.index') }}
            @endslot
            Konseling
        @endslot
        @slot('li_2')
            Laporan
        @endslot
    @endcomponent

    <x-alert />

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
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
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
                                        <td>{{ $report->student->student_id }}</td>
                                        <td>{{ $report->student->name }}</td>
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
                                            <a href="{{ route('Mgt.counseling.detail', $report->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                            @if(auth()->user()->role === 'admin')
                                                <form action="{{ route('counseling.updateStatus', $report->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
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
