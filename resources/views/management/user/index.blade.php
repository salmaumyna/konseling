@section('title', 'Daftar Pengguna')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Daftar Pengguna
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.user.index') }}
            @endslot
            Pengguna
        @endslot
        @slot('li_2')
            Daftar
        @endslot
        @slot('action_button')
            <a href="{{ route('mgt.user.create') }}" class="btn btn-gradient-primary">
                <i class="fa fa-plus"></i> Tambah Pengguna Baru
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
                            <a href="{{ route('mgt.user.index') }}"
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
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Hak Akses</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->levels == 'admin' ? 'Pengelola' : 'Guru' }}</td>
                                                <td class="text-end">
                                                    @if($isActive)
                                                        <a href="{{ route('mgt.user.edit', $user->id) }}"
                                                            class="btn btn-success btn-sm">
                                                            Ubah
                                                        </a>
                                                        @if($user->id != $currentId)
                                                            <button type="button"
                                                                data-action="{{ route('mgt.user.inactivate', $user->id) }}"
                                                                data-confirm-text="Anda yakin menonaktifkan pengguna ini?"
                                                                data-action-method="put"
                                                                class="btn btn-secondary btn-action btn-sm"
                                                            >
                                                                Non-Aktifkan
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button type="button"
                                                            data-action="{{ route('mgt.user.activate', $user->id) }}"
                                                            data-confirm-text="Anda yakin mengaktifkan pengguna ini?"
                                                            data-action-method="put"
                                                            class="btn btn-info btn-sm btn-action btn-sm text-white"
                                                        >
                                                            Aktifkan
                                                        </button>

                                                        @if($user->id != $currentId)
                                                            <button type="button"
                                                                data-action="{{ route('mgt.user.remove', $user->id) }}"
                                                                data-confirm-text="Anda yakin menghapus pengguna ini?"
                                                                data-action-method="delete"
                                                                class="btn btn-danger btn-sm btn-action btn-sm text-white"
                                                            >
                                                                Hapus
                                                            </button>
                                                        @endif
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
