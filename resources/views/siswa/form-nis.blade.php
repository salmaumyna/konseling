@extends('layout.plain')

@section('title', 'Form Pengisian NIS')

@section('content')

@include('layout.partials.head')
@stack('styles')
<style>
    body {
        background: #F5EFFF;
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
        margin-bottom: 30px;
    }

    .form-body label {
        font-weight: 600;
        color: #444;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        max-width: 355px;
        padding: 8px;
        margin-bottom: 8px;
        border: 2px solid #ced4da;
        border-radius: 6px;
        font-size: 14px;
        transition: 0.3s;
    }

    .form-group {
        margin-bottom: 1.25rem;
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
        justify-content: flex-end;
        align-items: center;
        margin-top: 15px;
        margin-right: 5px;
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
        margin-right: 10px;
        background: #B4B4B8;
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
        color: #BB5A5A;
        font-size: 13px;
        font-weight: bold;
    }

</style>

<x-alert />
<div class="form-container">
    <div class="form-card">
        <div class="form-header">
            Form Pengisian NIS
        </div>
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
                <span class="text-danger">*<sup> wajib diisi</sup></span>
            </div>
            <div class="form-footer">
                
                <a href="{{ route('index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Lanjutkan</button>
            </div>
        </form>
    </div>
</div>

@include('layout.partials.footer-scripts')
@stack('scripts')
@endsection
