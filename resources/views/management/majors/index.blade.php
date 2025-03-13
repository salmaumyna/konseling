@section('title', 'Daftar Kelas')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Kelas
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.majors.index') }}
            @endslot
            Kelas
        @endslot
        @slot('li_2')
            Daftar Kelas
        @endslot
        @slot('action_button')
            <a href="{{ route('mgt.majors.create') }}" class="btn btn-gradient-primary">
                <i class="fa fa-plus"></i> Tambah Kelas Baru
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
                            <a href="{{ route('mgt.majors.index') }}"
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
                                            <th>Nama Kelas</th>
                                            <th width="10%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($majors as $major)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $major->name }}</td>
                                                <td class="text-end">
                                                    @if($isActive)
                                                        <a href="{{ route('mgt.majors.edit', $major->id) }}"
                                                           class="btn btn-success btn-sm">
                                                            Ubah
                                                        </a>
                                                        
                                                            <button type="button"
                                                                    data-action="{{ route('mgt.majors.inactivate', $major->id) }}"
                                                                    data-confirm-text="Anda yakin menonaktifkan kelas ini?"
                                                                    data-action-method="put"
                                                                    class="btn btn-secondary btn-action btn-sm">
                                                                Non-Aktifkan
                                                            </button>
                                                       
                                                    @else
                                                        <button type="button"
                                                                data-action="{{ route('mgt.majors.activate', $major->id) }}"
                                                                data-confirm-text="Anda yakin mengaktifkan kelas ini?"
                                                                data-action-method="put"
                                                                class="btn btn-info btn-sm btn-action btn-sm text-white">
                                                            Aktifkan
                                                        </button>

                  
                                                            <button type="button"
                                                                    data-action="{{ route('mgt.majors.remove', $major->id) }}"
                                                                    data-confirm-text="Anda yakin menghapus kelas ini?"
                                                                    data-action-method="delete"
                                                                    class="btn btn-danger btn-sm btn-action btn-sm text-white">
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
