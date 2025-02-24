<?php

namespace App\Http\Controllers\Management;

use App\Models\CounselingReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\CounselingReportExport;
use Maatwebsite\Excel\Facades\Excel;

class Counseling_ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = CounselingReport::with(['student', 'class', 'major'])->orderBy('date', 'desc');

        // Filter berdasarkan NIS
        if ($request->filled('nis')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('nis', 'like', '%' . $request->nis . '%');
            });
        }

        // Filter berdasarkan Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $counselingReports = $query->get();

        return view('management.teacherOnduty.counseling-report', compact('counselingReports'));
    }

    public function show($id)
    {
        $report = CounselingReport::with(['student', 'class', 'major'])->findOrFail($id);
        return view('management.teacherOnduty.detail', compact('report'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'reason' => 'nullable|required_if:status,rejected',
        ]);

        $report = CounselingReport::findOrFail($id);
        $report->status = $request->status;
        $report->reason = $request->status === 'rejected' ? $request->reason : null;
        $report->save();

        return redirect()->route('mgt.counseling.index', $id)->with('success', 'Status berhasil diperbarui.');
    }
    public function exportExcel(Request $request)
    {
        return Excel::download(new CounselingReportExport($request->nis, $request->status), 'Laporan-Konseling.xlsx');
    }

}