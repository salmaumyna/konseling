<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\CounselingReport;

class CounselingStatusController extends Controller
{
    public function showNisForm()
    {
        return view('siswa.check-nis');
    }

    public function checkStatus(Request $request)
{
    $request->validate([
        'nis' => 'required|numeric|exists:students,nis',
    ]);

    // Cari data siswa berdasarkan NIS
    $student = Student::where('nis', $request->nis)->firstOrFail();

    // Ambil data pengajuan konseling milik siswa ini
    $counseling_reports = CounselingReport::where('student_id', $student->id)
        ->with(['teacher'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('siswa.form-check', compact('student', 'counseling_reports'));
}
}