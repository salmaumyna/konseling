@extends('layout.mainlayout')

@section('title', 'Ubah Tingkat')

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
            Form Ubah
        @endslot
    @endcomponent

    <x-alert />

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <form action="{{ route('mgt.classes.update', $class->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- Nama Jurusan -->
                    <div class="form-group">
                        <label>Nama Tingkat <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name', $class->name) }}">
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
                                <option disabled>Pilih Status</option>
                                <option value="1" @if (old('is_active', $class->is_active) == 1) selected @endif>Aktif</option>
                                <option value="0" @if (old('is_active', $class->is_active) == 0) selected @endif>Tidak Aktif</option>
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
