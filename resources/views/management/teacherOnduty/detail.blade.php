@extends('layout.mainlayout')

@section('title', 'Detail Laporan Konseling')

@section('content')
    @component('components.breadcrumb')
        @slot('title') Detail Laporan Konseling @endslot
        @slot('li_1') 
            @slot('link') {{ route('mgt.counseling.index') }} @endslot
            Konseling
        @endslot
        @slot('li_2') Detail @endslot
    @endcomponent

    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <div class="card mb-3">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3 row align-items-center">
                                <label class="col-sm-3 col-form-label"><strong>NIS</strong></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $report->student->nis }}" readonly>
                                </div>
                            </div>
                            <div class="form-group mb-3 row align-items-center">
                                <label class="col-sm-3 col-form-label"><strong>Nama Siswa</strong></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $report->student->nama }}" readonly>
                                </div>
                            </div>
                            <div class="form-group mb-3 row align-items-center">
                                <label class="col-sm-3 col-form-label"><strong>Kelas</strong></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $report->class->name ?? '-' }}" readonly>
                                </div>
                            </div>
                            <div class="form-group mb-3 row align-items-center">
                                <label class="col-sm-3 col-form-label"><strong>Tanggal Konseling</strong></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $report->date }}" readonly>
                                </div>
                            </div>
                            <div class="form-group mb-3 row align-items-center">
                                <label class="col-sm-3 col-form-label"><strong>Deskripsi</strong></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" readonly>{{ $report->description }}</textarea>
                                </div>
                            </div>

                            @if($report->status === 'pending')
                                <form action="{{ route('mgt.counseling.updateStatus', $report->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group mb-3 row align-items-center">
                                        <label class="col-sm-3 col-form-label"><strong>Ubah Status</strong></label>
                                        <div class="col-sm-9">
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="">-- Pilih Status --</option>
                                                <option value="approved">Disetujui</option>
                                                <option value="rejected">Ditolak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row align-items-center d-none" id="reasonDiv">
                                        <label class="col-sm-3 col-form-label"><strong>Alasan Penolakan</strong></label>
                                        <div class="col-sm-9">
                                            <textarea name="reason" id="reason" class="form-control" placeholder="Masukkan Alasan"></textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('mgt.counseling.index') }}" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            @else
                                <div class="form-group mb-3 row align-items-center">
                                    <label class="col-sm-3 col-form-label"><strong>Status</strong></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" 
                                            value="{{ $report->status === 'approved' ? 'Disetujui' : 'Ditolak' }}" readonly>
                                    </div>
                                </div>

                                @if($report->status === 'rejected')
                                    <div class="form-group mb-3 row align-items-center">
                                        <label class="col-sm-3 col-form-label"><strong>Alasan Penolakan</strong></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $report->reason }}" readonly>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="col-md-4 text-center">
                            @if($report->student->photo)
                                <img src="{{ Storage::url($report->student->photo) }}" alt="Foto Siswa" class="img-thumbnail" style="max-width: 200px;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let statusSelect = document.getElementById('status');
            let reasonDiv = document.getElementById('reasonDiv');
            let reasonInput = document.getElementById('reason');

            function toggleReasonField() {
                if (statusSelect.value === 'rejected') {
                    reasonDiv.classList.remove('d-none');
                    reasonInput.setAttribute('required', 'true');
                } else {
                    reasonDiv.classList.add('d-none');
                    reasonInput.removeAttribute('required');
                    reasonInput.value = ''; // Bersihkan input alasan jika bukan ditolak
                }
            }

            statusSelect.addEventListener('change', toggleReasonField);
        });
    </script>
@endsection
