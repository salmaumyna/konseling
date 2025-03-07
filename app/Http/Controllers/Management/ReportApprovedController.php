<?php

namespace App\Http\Controllers\Management;

use App\Models\CounselingReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ApprovedCounselingExport;

class ReportApprovedController extends Controller
{
    public function approved()
    {
        $nis = request('nis');
        $majorId = request('major_id'); 
        $teacherId = request('teacher_id');

        // Ambil tanggal dari input, jika tidak ada biarkan kosong (tidak difilter)
        $startDate = request('start_date');
        $endDate = request('end_date');

        // Ambil data jurusan dan guru BK untuk filter
        $majors = \App\Models\Major::all(); 
        $teachers = \App\Models\User::where('levels', 'teacher')->get();

        $counselingReports = CounselingReport::where('status', 'approved')
            ->when($nis, function ($query, $nis) {
                return $query->whereHas('student', function ($q) use ($nis) {
                    $q->where('nis', 'like', "%$nis%");
                });
            })
            ->when($majorId, function ($query, $majorId) {
                return $query->where('major_id', $majorId);
            })
            ->when($teacherId, function ($query, $teacherId) {
                return $query->where('teacher_id', $teacherId);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->with(['student', 'major', 'teacher'])
            ->orderBy('date', 'desc')
            ->get();

        return view('management.counseling-approved', compact('counselingReports', 'majors', 'teachers', 'startDate', 'endDate'));
    }

    public function downloadApproved()
    {
        return Excel::download(new ApprovedCounselingExport(), 'Laporan-Konseling-Approved.xlsx');
    }
}
