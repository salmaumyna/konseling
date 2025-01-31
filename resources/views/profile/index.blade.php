@section('title', 'Profil Pengguna')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Ubah Password
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.profile.index') }}
            @endslot
            Profil
        @endslot
        @slot('li_2')
            Form Ubah
        @endslot
    @endcomponent

    <x-alert />
            <div class="col-lg-12 strech-card">
                <div class="card">
                    <form action="{{ route('mgt.profile.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <div class="col-sm-12">
                                    <input type="text" readonly class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <div class="col-sm-12">
                                    <input type="text" readonly class="form-control" value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password Lama <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror">
                                    <div class="invalid-feedback">
                                        @error('old_password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password Baru <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                    <div class="invalid-feedback">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password <span class="text-danger">*</span></label>
                                <div class="col-sm-12">
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                                    <div class="invalid-feedback">
                                        @error('password_confirmation')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <span class="text-muted float-start">
                            <strong class="text-danger">*</strong> Harus diisi
                        </span>
                        <a href="{{ route('mgt.dashboard.index') }}" class="btn btn-secondary">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
@endsection
