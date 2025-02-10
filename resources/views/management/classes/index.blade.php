@section('title', 'Daftar Kelas')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Tingkat
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.classes.index') }}
            @endslot
            Tingkat
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('mgt.classes.create') }}" class="btn btn-gradient-primary">
                <i class="fa fa-plus"></i> Tambah Tingkat Baru
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
                            <a href="{{ route('mgt.classes.index') }}"
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
                                <table class="table table-striped mb-0"
                                       style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th>Nama Tingkat</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classes as $class)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $class->name }}</td>
                                                <td class="text-end">
                                                <a href="{{ route('mgt.classes.edit', $class->id) }}" class="btn btn-success btn-sm">Ubah</a>
                                                    @if($isActive)
                                                        <button type="button"
                                                                data-action="{{ route('mgt.classes.inactivate', $class->id) }}"
                                                                data-confirm-text="Anda yakin menonaktifkan tingkat ini?"
                                                                data-action-method="put"
                                                                class="btn btn-secondary btn-action btn-sm">
                                                            Non-Aktifkan
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                                data-action="{{ route('mgt.classes.activate', $class->id) }}"
                                                                data-confirm-text="Anda yakin mengaktifkan tingkat ini?"
                                                                data-action-method="put"
                                                                class="btn btn-info btn-action btn-sm text-white">
                                                            Aktifkan
                                                        </button>
                                                        <button type="button"
                                                                data-action="{{ route('mgt.classes.remove', $class->id) }}"
                                                                data-confirm-text="Anda yakin menghapus tingkat ini?"
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
