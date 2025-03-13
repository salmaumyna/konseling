<?php

namespace App\Http\Controllers\Management;

use App\Models\CounselingReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\CounselingReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class Counseling_ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->id;

        $query = CounselingReport::with(['student', 'class', 'major'])
        ->orderBy('created_at', 'desc') 
        ->where('teacher_id', $user);
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

        if ($request->has('action') && $request->action == 'download'){
            return Excel::download(new CounselingReportExport($counselingReports), 'Laporan konseling.xlsx');
        }

        

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
        ],[
            'status.required' => 'Status harus di isi!',
            'reason.required_if:status,rejected' => 'alasan penolakan harus di isi!'
        ]
    );

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