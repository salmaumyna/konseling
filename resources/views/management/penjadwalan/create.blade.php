@extends('layout.mainlayout')

@section('title', 'Tambah Jadwal Tidak Tersedia')

@section('content')
    @component('components.breadcrumb')
        @slot('title') Penjadwalan @endslot
        @slot('li_1')
            @slot('link') {{ route('mgt.schedules.index') }} @endslot
            Jadwal Tidak Tersedia
        @endslot
        @slot('li_2') Form Tambah Baru @endslot
    @endcomponent

    <x-alert />

    <div class="col-lg-12 stretch-card">
        <div class="card">
            <form action="{{ route('mgt.schedules.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="mb-2">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-2">Tanggal <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="date" name="date"
                                class="form-control @error('date') is-invalid @enderror" required>
                            <div class="invalid-feedback">
                                @error('date') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-2">Jam</label>
                        <div class="col-sm-12">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                                <label class="form-check-label" for="selectAll">
                                    Pilih Semua Jam
                                </label>
                            </div>
                            <div class="row">
                                @php
                                    $availableHours = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'];
                                @endphp
                                
                                @foreach($availableHours as $hour)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input time-checkbox" type="checkbox" name="times[]" value="{{ $hour }}" id="time{{ str_replace(':', '', $hour) }}">
                                            <label class="form-check-label" for="time{{ str_replace(':', '', $hour) }}">
                                                {{ $hour }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-text text-muted">
                                Kosongkan jika tidak tersedia seharian penuh
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end">
                    <span class="text-muted float-start">
                        <strong class="text-danger">*</strong> Harus diisi
                    </span>
                    <a class="btn btn-secondary" href="{{ route('mgt.schedules.index') }}">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select All functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const timeCheckboxes = document.querySelectorAll('.time-checkbox');
        
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            
            timeCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
        
        // Update "Select All" checkbox state based on individual checkboxes
        timeCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(timeCheckboxes).every(cb => cb.checked);
                const noneChecked = Array.from(timeCheckboxes).every(cb => !cb.checked);
                
                if (allChecked) {
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                } else if (noneChecked) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                } else {
                    selectAllCheckbox.indeterminate = true;
                }
            });
        });
    });
</script>
@endpush