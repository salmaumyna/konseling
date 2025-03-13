@section('title', 'Jadwal Tidak Tersedia')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Jadwal Tidak Tersedia
        @endslot
        @slot('li_1')
            Penjadwalan
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('mgt.schedules.create') }}" class="btn btn-gradient-primary">
                <i class="fa fa-plus"></i> Tambah Jadwal Baru
            </a>
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <!-- Filter Form -->
[        <form action="{{ route('mgt.schedules.index') }}" method="GET" class="mb-4" id="schedule-filter-form">
            <div class="row align-items-end">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="date_start">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="date_start" name="date_start" 
                            value="{{ request('date_start') }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="date_end">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="date_end" name="date_end"
                            value="{{ request('date_end') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100" id="filter-submit-btn">
                            <i class="fa fa-search"></i> Filter
                        </button>
                    </div>
                </div>
            </div>
        </form>
            <div class="card">
                
                <div class="card-body">

                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <a href="{{ route('mgt.schedules.index') }}"
                               class="nav-link active">
                                Jadwal Tidak Tersedia&nbsp;
                                <span class="badge badge-primary">{{ $schedules->count() }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0"
                                       style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th width="15%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $schedule->date->format('d F Y') }}</td>
                                                <td>
                                                    @if($schedule->time)
                                                        {{ $schedule->time->format('H:i') }}
                                                    @else
                                                        <span class="badge bg-warning">Seharian</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="{{ route('mgt.schedules.edit', $schedule->id) }}"
                                                       class="btn btn-success btn-sm">
                                                        Ubah
                                                    </a>
                                                    
                                                    <button type="button"
                                                            data-action="{{ route('mgt.schedules.remove', $schedule->id) }}"
                                                            data-confirm-text="Anda yakin menghapus jadwal ini?"
                                                            data-action-method="delete"
                                                            class="btn btn-danger btn-sm btn-action text-white">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-3">Belum ada jadwal tidak tersedia</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection