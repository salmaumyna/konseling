@extends('layout.mainlayout')

@section('title', 'Tambah Tingkat')

@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Tingkat
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.classes.index') }}
            @endslot
            Tingkat
        @endslot
        @slot('li_2')
            Form Tambah Baru
        @endslot
    @endcomponent

    <x-alert />

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <form action="{{ route('mgt.classes.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <!-- Nama Kelas -->
                    <div class="form-group">
                        <label>Nama Tingkat <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            <div class="invalid-feedback">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select class="js-example-basic-single" style="width:100%" name="is_active">
                                <option disabled selected>Pilih Status</option>
                                <option value="1" @if (old('is_active') == 1) selected @endif>Aktif</option>
                                <option value="0" @if (old('is_active') == 0) selected @endif>Tidak Aktif</option>
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
                    <a class="btn btn-secondary" href="{{ route('mgt.classes.index') }}">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
