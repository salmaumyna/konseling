@extends('layout.mainlayout')

@section('title', 'Ubah Siswa')

@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Siswa
        @endslot
        @slot('li_1')
            @slot('link')
                {{ route('mgt.students.index') }}
            @endslot
            Siswa
        @endslot
        @slot('li_2')
            Form Ubah
        @endslot
    @endcomponent

    <x-alert />

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <form action="{{ route('mgt.students.update', $student->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>NIS <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input name="nis" type="text" class="form-control @error('nis') is-invalid @enderror" required value="{{ old('nis', $student->nis) }}">
                            <div class="invalid-feedback">
                                @error('nis')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" required value="{{ old('nama', $student->nama) }}">
                            <div class="invalid-feedback">
                                @error('nama')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tingkat <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select class="js-example-basic-single" style="width:100%" name="tingkat" required>
                                <option disabled>Pilih Tingkat</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" @if(old('tingkat', $student->tingkat) == $class->id) selected @endif>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tingkat')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nama Kelas <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select class="js-example-basic-single" style="width:100%" name="nama_kelas" required>
                                <option disabled>Pilih Nama Kelas</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}" @if(old('nama_kelas', $student->nama_kelas) == $major->id) selected @endif>
                                        {{ $major->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nama_kelas')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <select name="is_active" class="js-example-basic-single" style="width:100%">
                                <option disabled>Pilih Status</option>
                                <option value="1" @if(old('is_active', $student->is_active) == 1) selected @endif>Aktif</option>
                                <option value="0" @if(old('is_active', $student->is_active) == 0) selected @endif>Tidak Aktif</option>
                            </select>
                            @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <span class="text-muted float-start">
                        <strong class="text-danger">*</strong> Harus diisi
                    </span>
                    <a class="btn btn-secondary" href="{{ route('mgt.students.index') }}">Kembali</a>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
