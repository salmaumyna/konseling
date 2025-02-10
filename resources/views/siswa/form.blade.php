@extends('layout.plain')

@section('title', 'Form Pengajuan Konseling')

@section('content')
<style>
    body {
        background: #f8f9fc;
        font-family: 'Poppins', sans-serif;
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .form-card {
        width: 420px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .form-header {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: 600;
        color: #444;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 2px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        border: none;
    }

    .btn-primary {
        background: #17a2b8;
        color: white;
    }

    .btn-primary:hover {
        background: #138496;
    }

    .text-danger {
        font-size: 13px;
        font-weight: bold;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">Form Pengajuan Jadwal Konseling</div>
        <x-alert />
        <form action="{{ route('counseling.submit') }}" method="post">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student->id }}">
            <input type="hidden" name="class_id" value="{{ $student->nama_kelas }}">
            <input type="hidden" name="major_id" value="{{ $student->tingkat }}">

            <div class="form-group">
                <label>NIS</label>
                <input type="text" class="form-control" value="{{ $student->nis }}" readonly>
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" value="{{ $student->nama }}" readonly>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <input type="text" class="form-control" value="{{ $student->kelas->name ?? '-' }}" readonly>
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" class="form-control" value="{{ $student->major->name ?? '-' }}" readonly>
            </div>

            <div class="form-group">
                <label>Guru BK <span class="text-danger">*</span></label>
                <select name="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror">
                    <option value="">-- Pilih Guru BK --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Konseling <span class="text-danger">*</span></label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Alasan Konseling <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="card-footer text-end">
                        <span class="text-muted float-start">
                            <strong class="text-danger">*</strong> Harus diisi
                        </span>
                        <a href="{{ route('counseling.nis') }}" class="btn btn-primary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>

        </form>
    </div>
</div>

@endsection
