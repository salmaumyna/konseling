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
    public function index()
    {
        return view('siswa.form-nis');
    }

    public function store(Request $request)
    {   
        $request->validate(
            [
                'nis' => [
                    'required',
                    Rule::exists('students', 'nis')->where(function ($query) {
                        $query->where('is_active', true);
                    }),
                ],
            ],
            [
                'nis.required' => 'NIS wajib diisi!',
                'nis.exists' => 'Siswa tidak ditemukan atau tidak aktif!',
            ]
        );

        $nis = $request->nis;

        return redirect()->route('student.counseling.form', ['nis' => $nis]);
    }
}
