@extends('layout.plain')

@section('title', 'Form Pengajuan Konseling')

@section('content')

@include('layout.partials.head')
@stack('styles')
<style>
    body {
        background: url('/assets/img/bg-nis.png') no-repeat center center fixed;
        background-size: cover;
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin-bottom: 30px;
    }

    .form-card {
        width: 500px;
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
        margin-bottom: 40px;
        margin-top: 10px;
    }

    .form-group label {
        font-weight: 600;
        color: #444;
        display: block;
        margin-bottom: 10px;
    }

    .form-control {
        width: 100%;
        max-width: 455px;
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
    .btn-secondary:hover {
        background: #BFA2DB;
    }

    .text-danger {
        color: #BB5A5A;
        font-size: 13px;
        font-weight: bold;
    }
    
    #time-checkboxes {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        padding-left: 0;
        padding-right: 0;
        margin-left: -4px;
        margin-right: -8px;
    }
    
    #time-checkboxes .col-md-4 {
        padding: 0 8px;
    }
    
    .form-check {
        padding-left: 5px;
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="form-header">Form Pengajuan Jadwal Konseling</div>
        <x-alert />
        <form action="{{ route('counseling.submit') }}" method="post">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student->id }}">
            <input type="hidden" name="class_id" value="{{ $student->kelas->id }}">
            <input type="hidden" name="major_id" value="{{ $student->major->id }}">

            <div class="form-group">
                <label>NIS</label>
                <input type="text" class="form-control" value="{{ $student->nis }}" disabled readonly>
            </div>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" value="{{ $student->nama }}" disabled readonly>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <input type="text" class="form-control" value="{{ $student->kelas->name ?? '-' }}" disabled readonly>
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <input type="text" class="form-control" value="{{ $student->major->name ?? '-' }}" disabled readonly>
            </div>


            <div class="form-group">
                <label>Guru BK <span class="text-danger">*</span></label>
                <select name="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror">
                    <option value="">-- Pilih Guru BK --</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Konseling <span class="text-danger">*</span></label>
                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="time-selection" style="display:none;">
                <label>Jam Konseling <span class="text-danger">*</span></label>
                <div id="time-checkboxes">
                    @foreach($availableHours as $hour)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input time-checkbox" type="radio" name="time" value="{{ $hour }}" id="time{{ str_replace(':', '', $hour) }}" {{ old('time') == $hour ? 'checked' : '' }}>
                                <label class="form-check-label time-label" for="time{{ str_replace(':', '', $hour) }}">
                                    {{ $hour }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="full-day-unavailable" class="alert alert-warning" style="display:none;">
                    Guru BK tidak tersedia pada tanggal yang dipilih. Silakan pilih tanggal lain.
                </div>
                @error('time')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Alasan Konseling <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <span class="text-muted">
                <strong class="text-danger">* Harus diisi</strong>
            </span>
            <div class="card-footer text-end">
                <a href="{{ route('counseling.nis') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-block btn-gradient-primary">Kirim</button>
            </div>

        </form>
    </div>
</div>

@include('layout.partials.footer-scripts')
@stack('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const teacherSelect = document.querySelector('select[name="teacher_id"]');
        const dateInput = document.querySelector('input[name="date"]');
        const timeSelection = document.getElementById('time-selection');
        const timeCheckboxes = document.querySelectorAll('.time-checkbox');
        const timeLabels = document.querySelectorAll('.time-label');
        const fullDayUnavailableAlert = document.getElementById('full-day-unavailable');
        
        function checkAvailability() {
            const teacherId = teacherSelect.value;
            const date = dateInput.value;
            
            if (!teacherId || !date) {
                timeSelection.style.display = 'none';
                return;
            }
            
            timeCheckboxes.forEach(checkbox => {
                checkbox.disabled = false;
                checkbox.checked = false;
            });
            
            timeLabels.forEach(label => {
                label.style.textDecoration = '';
                label.style.color = '';
            });
            
            fullDayUnavailableAlert.style.display = 'none';
            
            $.ajax({
                url: '/counseling/unavailable-times',
                type: 'GET',
                data: {
                    teacher_id: teacherId,
                    date: date
                },
                dataType: 'json',
                success: function(data) {
                    if (data.full_day) {
                        fullDayUnavailableAlert.style.display = 'block';
                        timeCheckboxes.forEach(checkbox => {
                            checkbox.disabled = true;
                        });
                    } else {
                        data.unavailable_times.forEach(time => {
                            const checkbox = document.getElementById(`time${time.replace(':', '')}`);
                            if (checkbox) {
                                checkbox.disabled = true;
                                
                                const label = document.querySelector(`label[for="time${time.replace(':', '')}"]`);
                                if (label) {
                                    label.style.textDecoration = 'line-through';
                                    label.style.color = '#999';
                                }
                            }
                        });
                    }
                    
                    timeSelection.style.display = 'block';
                },
                error: function(xhr, status, error) {
                    alert('Error.');
                }
            });
        }

        $(teacherSelect).on('change', checkAvailability);
        $(dateInput).on('change', checkAvailability);
        
        if (teacherSelect.value && dateInput.value) {
            checkAvailability();
        }
    });
</script>
@endsection