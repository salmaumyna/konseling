<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Major;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $isActive = $request->view !== 'inactive';

        $activeCount   = Student::where('is_active', true)->count();
        $inactiveCount = Student::where('is_active', false)->count();

        $students = Student::with(['kelas', 'major'])
            ->where('is_active', $isActive)
            ->get();

        return view('management.students.index', compact('students', 'isActive', 'activeCount', 'inactiveCount'));
    }

    public function create()
    {
        $classes = ClassModel::where('is_active', true)->select('id', 'name')->get(); 
        $majors = Major::where('is_active', true)->select('id', 'name')->get(); 
    
        return view('management.students.create', compact('classes', 'majors'));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'nis'        => 'required|string|max:50',
            'nama'       => 'required|string|max:255',
            'tingkat'    => 'required|exists:classes,id',
            'nama_kelas' => 'required|exists:majors,id',
            'is_active'  => 'required|boolean',
        ], [
            'nis.required'        => 'NIS harus diisi!',
            'nama.required'       => 'Nama siswa harus diisi!',
            'tingkat.required'    => 'Tingkat harus dipilih!',
            'tingkat.exists'      => 'Tingkat yang dipilih tidak valid!',
            'nama_kelas.required' => 'Nama kelas harus dipilih!',
            'nama_kelas.exists'   => 'Nama kelas yang dipilih tidak valid!',
            'is_active.required'  => 'Status harus diisi!',
            'is_active.boolean'   => 'Status hanya boleh diisi dengan nilai boolean!',
        ]);

        Student::create([
            'nis'        => $request->nis,
            'nama'       => $request->nama,
            'tingkat'    => $request->tingkat,
            'nama_kelas' => $request->nama_kelas,
            'is_active'  => $request->is_active,
        ]);

        return redirect()->route('mgt.students.index')->withSuccess('Siswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $classes = ClassModel::where('is_active', true)->get();
        $majors  = Major::where('is_active', true)->get();

        return view('management.students.edit', compact('student', 'classes', 'majors'));
    }


    public function update($id, Request $request)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $request->validate([
            'nis' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
            'tingkat' => 'required|exists:classes,id',
            'nama_kelas' => 'required|exists:majors,id',
            'is_active' => 'required|boolean',
        ], [
            'nis.required' => 'NIS harus diisi!',
            'nama.required' => 'Nama siswa harus diisi!',
            'tingkat.required' => 'Tingkat harus dipilih!',
            'tingkat.exists' => 'Tingkat yang dipilih tidak valid!',
            'nama_kelas.required' => 'Nama kelas harus dipilih!',
            'nama_kelas.exists' => 'Nama kelas yang dipilih tidak valid!',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi dengan nilai boolean!',
        ]);

        $student->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tingkat' => $request->tingkat,
            'nama_kelas' => $request->nama_kelas,
            'is_active' => $request->is_active,
        ]);

        // Periksa status kelas dan jurusan setelah update
        $class = ClassModel::find($request->tingkat);
        $major = Major::find($request->nama_kelas);

        if (!$class->is_active || !$major->is_active) {
            $student->update(['is_active' => false]);
        }

        return redirect()->route('mgt.students.index')->withSuccess('Siswa berhasil diperbarui!');
    }

    public function activate($id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $student->update(['is_active' => true]);

        return redirect()->route('mgt.students.index', ['view' => 'active'])->withSuccess('Siswa berhasil diaktifkan!');
    }

    public function inactivate($id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $student->update(['is_active' => false]);

        return redirect()->route('mgt.students.index', ['view' => 'inactive'])->withSuccess('Siswa berhasil dinonaktifkan!');
    }

    public function remove($id)
    {
        $student = Student::find($id);
        abort_if(!$student, 400, 'Siswa tidak ditemukan');

        $student->delete();

        return redirect()->route('mgt.students.index')->withSuccess('Siswa berhasil dihapus!');
    }
}
