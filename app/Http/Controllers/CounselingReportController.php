<?php
namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\CounselingReport;
use App\Models\Major;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CounselingReportController extends Controller
{
    public function showNisForm()
    {
        return view('siswa.form-nis');
    }

    public function processNis(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|exists:students,nis',
        ], [
            'nis.required' => 'NIS wajib diisi!',
            'nis.numeric' => 'NIS harus berupa angka!',
            'nis.exists' => 'NIS tidak ditemukan!',
        ]);

        return redirect()->route('counseling.form', ['nis' => $request->nis]);
    }

    public function showForm($nis)
    {
        $student = Student::where('nis', $nis)->firstOrFail(); // Tetap pakai nis untuk pencarian
        $teachers = User::where('levels', 'teacher')->get();

        if ($teachers->isEmpty()) {
            return redirect()->route('counseling.nis')->with('error', 'Belum ada guru BK yang tersedia.');
        }

        return view('siswa.form', compact('student', 'teachers'));
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:classes,id',
            'major_id' => 'required|exists:majors,id',
            'teacher_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'description' => 'required|string|max:255',
        ], [
            'date.after_or_equal' => 'Tanggal konseling tidak boleh di masa lalu.',
            'description.required' => 'Alasan wajib diisi.',
            'teacher_id.required' => 'Guru wajib diisi.',
            'date.required' => 'Tanggal wajib diisi.',
        ]);

        CounselingReport::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id, 
            'major_id' => $request->major_id, 
            'teacher_id' => $request->teacher_id,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('counseling.nis')->withSuccess('Pengajuan berhasil dikirim!');
    }
}
