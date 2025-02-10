@extends('layout.plain')

@section('title', 'Form Pengisian NIS')

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
        width: 380px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: 0.3s;
    }

    .form-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .form-header {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    .form-body label {
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
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #17a2b8;
        outline: none;
        box-shadow: 0px 0px 5px rgba(23, 162, 184, 0.5);
    }

    .invalid-feedback {
        color: red;
        font-size: 13px;
        margin-top: 5px;
    }

    .form-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
        border: none;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }

    .btn-info {
        background: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background: #138496;
    }

    .text-danger {
        font-size: 13px;
        font-weight: bold;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            Form Pengisian NIS
        </div>
        <x-alert />
        <form action="{{ route('counseling.process') }}" method="POST">
            @csrf
            <div class="form-body">
                <label for="nis">NIS <span class="text-danger">*</span></label>
                <input type="number" id="nis" name="nis" 
                       class="form-control @error('nis') is-invalid @enderror" 
                       value="{{ old('nis') }}" placeholder="Masukkan NIS" autofocus>
                @error('nis')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-footer">
                <span class="text-danger"><strong>*</strong> Wajib diisi</span>
                <a href="{{ route('counseling.nis') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-info">Lanjutkan</button>
            </div>
        </form>
    </div>
</div>
@endsection
