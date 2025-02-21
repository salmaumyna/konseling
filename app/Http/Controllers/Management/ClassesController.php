<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
        $isActive = $request->view !== 'inactive';

        $activeCount = ClassModel::where('is_active', true)->count();
        $inactiveCount = ClassModel::where('is_active', false)->count();
        $classes = ClassModel::where('is_active', $isActive)->get();

        return view(
            'management.classes.index',
            compact(
                'isActive',
                'classes',
                'activeCount',
                'inactiveCount'
            )
        );
    }

    // Menampilkan form untuk membuat tingkat baru
    public function create()
    {
        return view('management.classes.create');
    }

    // Menyimpan data tingkat baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Nama tingkat harus diisi!',
            'name.max' => 'Nama tingkat maksimal 255 karakter!',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi dengan nilai boolean (true/false)!',
        ]);

        ClassModel::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('mgt.classes.index')->withSuccess('tingkat berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit tingkat
    public function edit($id)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        return view('management.classes.edit', compact('class'));
    }

    // Mengupdate data tingkat
    public function update($id, Request $request)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        $request->validate([
            'name' => 'required|max:255',
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Nama tingkat harus diisi!',
            'name.max' => 'Nama tingkat maksimal 255 karakter!',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi dengan nilai boolean (true/false)!',
        ]);

        $class->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('mgt.classes.index')->withSuccess('tingkat berhasil diperbarui!');
    }

    // Mengaktifkan tingkat
    public function activate($id)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        $class->is_active = true;
        $class->save();

        return redirect()->route('mgt.classes.index', ['view' => 'active'])->withSuccess('tingkat berhasil diaktifkan!');
    }

    // Menonaktifkan tingkat
    public function inactivate($id)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        $class->is_active = false;
        $class->save();

        return redirect()->route('mgt.classes.index', ['view' => 'inactive'])->withSuccess('tingkat berhasil dinonaktifkan!');
    }

    // Menghapus tingkat
    public function remove($id)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        $class->delete();

        return redirect()->route('mgt.classes.index', ['view' => 'inactive'])->withSuccess('tingkat berhasil dihapus!');
    }
}
