@section('title', 'Tambah Pengguna')

@extends('layout.mainlayout')
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Pengguna
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.user.index') }}
            @endslot
            Pengguna
        @endslot
        @slot('li_2')
            Form Tambah Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="col-lg-12 strech-card">
            <div class="card">
                <form action="{{ route('mgt.user.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="name" maxlength="255" minlength="3"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    value="{{ old('username') }}">
                                <div class="invalid-feedback">
                                    @error('username')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                              <label>Hak Akses <span class="text-danger">*</span></label>
                              <div class="col-sm-12">
                                  <select class="js-example-basic-single" style="width:100%" name="levels">
                                      <option disabled selected>Pilih Hak Akses</option>
                                      <option value="admin" {{ old('levels') }}>Pengelola</option>
                                      <option value="employee" {{ old('levels') }}>Pegawai
                                      </option>
                                  </select>
                                @if ($errors->has('levels'))
                                    <span class="text-danger">{{ $errors->first('levels') }}</span>
                                @endif
                              </div>
                          </div>
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="js-example-basic-single" style="width:100%" name="is_active">
                                    <option disabled selected>Pilih Status</option>
                                    <option value="1" {{ old('is_active') }}>Aktif</option>
                                    <option value="0" {{ old('is_active') }}>Tidak Aktif
                                    </option>
                                </select>
                                @if ($errors->has('is_active'))
                                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <span class="text-muted float-start">
                            <strong class="text-danger">*</strong> Harus diisi
                        </span>
                        <a class="btn btn-secondary" href="{{ route('mgt.user.index') }}">Kembali</a>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
