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

        $counselingReports = CounselingReport::where('status', 'approved')
            ->when($nis, function ($query, $nis) {
                return $query->whereHas('student', function ($q) use ($nis) {
                    $q->where('nis', 'like', "%$nis%");
                });
            })
            ->with(['student', 'class', 'major', 'teacher']) // Pastikan mengambil data guru
            ->orderBy('date', 'desc')
            ->get();

        return view('management.counseling-approved', compact('counselingReports'));
    }

    public function downloadApproved()
    {
        return Excel::download(new ApprovedCounselingExport, 'Laporan-Konseling-Approved.xlsx');
    }

}
