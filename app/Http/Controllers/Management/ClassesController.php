<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function create()
    {
        return view('management.classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('classes', 'name'),
            ],
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Nama tingkat harus diisi!',
            'name.max' => 'Nama tingkat maksimal 255 karakter!',
            'name.unique' => 'Nama tingkat sudah digunakan!',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi dengan nilai boolean (true/false)!',
        ]);

        ClassModel::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('mgt.classes.index')->withSuccess('tingkat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        return view('management.classes.edit', compact('class'));
    }

    public function update($id, Request $request)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('classes', 'name')->ignore($id),
            ],
            'is_active' => 'required|boolean',
        ], [
            'name.required' => 'Nama tingkat harus diisi!',
            'name.max' => 'Nama tingkat maksimal 255 karakter!',
            'name.unique' => 'Nama tingkat sudah digunakan!',
            'is_active.required' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi dengan nilai boolean (true/false)!',
        ]);

        $class->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('mgt.classes.index')->withSuccess('tingkat berhasil diperbarui!');
    }

    public function activate($id)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        $class->is_active = true;
        $class->save();

        return redirect()->route('mgt.classes.index', ['view' => 'active'])->withSuccess('tingkat berhasil diaktifkan!');
    }

    public function inactivate($id)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        $class->is_active = false;
        $class->save();

        return redirect()->route('mgt.classes.index', ['view' => 'inactive'])->withSuccess('tingkat berhasil dinonaktifkan!');
    }

    public function remove($id)
    {
        $class = ClassModel::find($id);
        abort_if(!$class, 400, 'tingkat tidak ditemukan');

        $class->delete();

        return redirect()->route('mgt.classes.index', ['view' => 'inactive'])->withSuccess('tingkat berhasil dihapus!');
    }
}