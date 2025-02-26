<?php

namespace App\Http\Controllers\Management;

use App\Models\CounselingReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApprovedCounselingExport;
use Carbon\Carbon;

class ReportApprovedController extends Controller
{
    public function approved()
    {
        $nis = request('nis');
        $majorId = request('major_id'); // Ubah dari class_id ke major_id
        $teacherId = request('teacher_id');

        // Set tanggal default hari ini jika tidak ada input
        $startDate = request('start_date', Carbon::today()->toDateString());
        $endDate = request('end_date', Carbon::today()->toDateString());

        // Ambil data jurusan dan guru BK untuk filter
        $majors = \App\Models\Major::all(); // Ganti dari `ClassModel` ke `Major`
        $teachers = \App\Models\User::where('levels', 'teacher')->get();

        $counselingReports = CounselingReport::where('status', 'approved')
            ->when($nis, function ($query, $nis) {
                return $query->whereHas('student', function ($q) use ($nis) {
                    $q->where('nis', 'like', "%$nis%");
                });
            })
            ->when($majorId, function ($query, $majorId) {
                return $query->where('major_id', $majorId); // Ganti dari `class_id` ke `major_id`
            })
            ->when($teacherId, function ($query, $teacherId) {
                return $query->where('teacher_id', $teacherId);
            })
            ->whereBetween('date', [$startDate, $endDate]) // Filter tanggal
            ->with(['student', 'major', 'teacher']) // Hapus 'class'
            ->orderBy('date', 'desc')
            ->get();

        return view('management.counseling-approved', compact('counselingReports', 'majors', 'teachers', 'startDate', 'endDate'));
    }

    public function downloadApproved()
    {
        return Excel::download(new ApprovedCounselingExport(), 'Laporan-Konseling-Approved.xlsx');
    }
    
}
