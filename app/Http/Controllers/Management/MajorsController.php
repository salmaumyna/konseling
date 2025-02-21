<?php

namespace App\Http\Controllers\Management;

use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MajorsController extends Controller
{
    // Menampilkan daftar jurusan
    
    public function index(Request $request)
    {
        $isActive = $request->view !== 'inactive';

        $activeCount = Major::where('is_active', true)->count();
        $inactiveCount = Major::where('is_active', false)->count();
        $majors = Major::where('is_active', $isActive)->get();

        return view(
            'management.majors.index',
            compact(
                'isActive',
                'majors',
                'activeCount',
                'inactiveCount'
            )
        );
    }

    // Menampilkan form untuk membuat jurusan baru
    public function create()
    {
        return view('management.majors.create');
    }

    // Menyimpan data jurusan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Nama kelas harus diisi!',
            'name.max' => 'Nama kelas maksimal 255 karakter!',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi dengan nilai boolean (true/false)!',
        ]);

        Major::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('mgt.majors.index')->withSuccess('kelas berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit kelas
    public function edit($id)
    {
        $major = Major::find($id);
        abort_if(!$major, 400, 'kelas tidak ditemukan');

        return view('management.majors.edit', compact('major'));
    }

    // Mengupdate data kelas
    public function update($id, Request $request)
    {
        $major = Major::find($id);
        abort_if(!$major, 400, 'kelas tidak ditemukan');

        $request->validate([
            'name' => 'required|max:255',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Nama kelas harus diisi!',
            'name.max' => 'Nama kelas maksimal 255 karakter!',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi dengan nilai boolean (true/false)!',
        ]);

        $major->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('mgt.majors.index')->withSuccess('kelas berhasil diperbarui!');
    }

    // Mengaktifkan kelas
    public function activate($id)
    {
        $major = Major::find($id);
        abort_if(!$major, 400, 'kelas tidak ditemukan');

        $major->update(['is_active' => true]);

        return redirect()->route('mgt.majors.index', ['view' => 'active'])->withSuccess('kelas berhasil diaktifkan!');
    }

    // Menonaktifkan kelas
    public function inactivate($id)
    {
        $major = Major::find($id);
        abort_if(!$major, 400, 'kelas tidak ditemukan');

        $major->update(['is_active' => false]);

        return redirect()->route('mgt.majors.index', ['view' => 'inactive'])->withSuccess('kelas berhasil dinonaktifkan!');
    }

    // Menghapus kelas
    public function remove($id)
    {
        $major = Major::find($id);
        abort_if(!$major, 400, 'kelas tidak ditemukan');

        $major->delete();

        return redirect()->route('mgt.majors.index', ['view' => 'inactive'])->withSuccess('kelas berhasil dihapus!');
    }
}
