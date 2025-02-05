@extends('layout.mainlayout')
@section('title', 'Daftar Siswa')

@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Siswa
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.students.index') }}
            @endslot
            Siswa
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('mgt.students.create') }}" class="btn btn-gradient-primary">
                <i class="fa fa-plus"></i> Tambah Siswa Baru
            </a>
        @endslot
    @endcomponent

    <x-alert />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <a href="{{ route('mgt.students.index') }}"
                               class="nav-link {{ $isActive ? 'active' : '' }}">
                                Aktif&nbsp;
                                <span class="badge badge-primary">{{ $activeCount }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?view=inactive"
                               class="nav-link {{ !$isActive ? 'active' : '' }}">
                                Tidak Aktif&nbsp;
                                <span class="badge badge-danger">{{ $inactiveCount }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>NIS</th>
                                            <th>Nama Siswa</th>
                                            <th>Tingkat</th>
                                            <th>Nama Kelas</th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->nis }}</td>
                                                <td>{{ $student->nama }}</td>
                                                <td>{{ $student->kelas->name ?? '-' }}</td>
                                                <td>{{ $student->major->name ?? '-' }}</td>
                                                <td class="text-end">
                                                    <a href="{{ route('mgt.students.edit', $student->id) }}" class="btn btn-success btn-sm">Ubah</a>
                                                    @if($isActive)
                                                        <button type="button"
                                                                data-action="{{ route('mgt.students.inactivate', $student->id) }}"
                                                                data-confirm-text="Anda yakin menonaktifkan siswa ini?"
                                                                data-action-method="put"
                                                                class="btn btn-secondary btn-action btn-sm">
                                                            Non-Aktifkan
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                                data-action="{{ route('mgt.students.activate', $student->id) }}"
                                                                data-confirm-text="Anda yakin mengaktifkan siswa ini?"
                                                                data-action-method="put"
                                                                class="btn btn-info btn-action btn-sm text-white">
                                                            Aktifkan
                                                        </button>
                                                        <button type="button"
                                                                data-action="{{ route('mgt.students.remove', $student->id) }}"
                                                                data-confirm-text="Anda yakin menghapus siswa ini?"
                                                                data-action-method="delete"
                                                                class="btn btn-danger btn-action btn-sm text-white">
                                                            Hapus
                                                        </button>
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
        </div>
    </div>
@endsection
