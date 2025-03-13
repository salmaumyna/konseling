@extends('layout.mainlayout')
@section('title', 'Laporan penjadwalan guru')

@section('content')
    @component('components.breadcrumb')
        @slot('title') Laporan penjadwalan guru @endslot
        @slot('li_1') 
            @slot('link') {{ route('mgt.reportschedule.index') }} @endslot
            Penjadwalan
        @endslot
        @slot('li_2') Laporan @endslot
    @endcomponent

    <x-alert />

    <form method="GET" action="{{ route('mgt.reportschedule.index') }}" class="mb-4" id="report-filter-form">
        
                <h5 class="card-title mb-3">Filter Laporan</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                value="{{ request('name') }}" placeholder="Cari berdasarkan nama">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="date_start" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="date_start" id="date_start" class="form-control" value="{{ request('date_start') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="date_end" class="form-label">Tanggal Akhir</label>
                            <input type="date" name="date_end" id="date_end" class="form-control" value="{{ request('date_end') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fa fa-search me-1"></i> Filter
                        </button>
                        <a href="{{ route('mgt.reportschedule.index') }}" class="btn btn-secondary me-2">
                            <i class="fa fa-refresh me-1"></i> Reset
                        </a>
                        <a href="{{ route('mgt.reportschedule.download') }}" class="btn btn-success">
                            <i class="fa fa-file-excel me-1"></i> Download Excel
                        </a>
                    </div>
                </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $schedule->user->name }}</td>
                                <td>{{ $schedule->date->format('d F Y') }}</td>
                                <td>
                                    @if($schedule->time)
                                        {{ $schedule->time->format('H:i') }}
                                    @else
                                        <span class="badge bg-warning">Seharian</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection