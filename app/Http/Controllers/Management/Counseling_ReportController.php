<?php

namespace App\Http\Controllers\Management;

use App\Models\CounselingReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Counseling_ReportController extends Controller
{
    public function index()
    {
        // Ambil data dengan relasi ke tabel lain
        $counselingReports = CounselingReport::with(['student', 'class', 'major'])
            ->orderBy('date', 'desc')
            ->get();

        return view('management.teacherOnduty.counseling-reports.index', compact('counselingReports'));
    }

    public function show($id)
    {
        $report = CounselingReport::with(['student', 'class', 'major'])
            ->findOrFail($id);

        return view('counseling.reports.detail', compact('report'));
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $report = CounselingReport::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        return redirect()->route('counseling.index')->with('success', 'Status laporan diperbarui.');
    }
}
