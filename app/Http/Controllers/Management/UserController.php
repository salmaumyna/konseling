<?php

namespace App\Http\Controllers\Management;

use App\Enums\Permission\ManagementPermission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $isActive = $request->view !== 'inactive';

        $activeCount = User::isActive()->count();
        $inactiveCount = User::isInactive()->count();
        $users = User::where('is_active', $isActive)->get();

        $user = auth()->user();
        $currentId = $user->id;

        return view(
            'management.user.index',
            compact(
                'isActive',
                'users',
                'activeCount',
                'inactiveCount',
                'currentId',
            )
        );
    }

    public function create()
    {
        return view('management.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:255',
            'username'  => 'required|alpha_num:ascii|min:5|max:255',
            'password'  => 'required|confirmed|min:5|max:255',
            'levels' => 'required|min:1',
            'is_active' => 'required|boolean'
        ],[
            'name.required'         => 'Nama harus diisi!',
            'username.required'     => 'Username harus diisi!',
            'username.alpha_num'    => 'Username hanya boleh diisi karakter A-Z a-z 0-9!',
            'password.required'     => 'Password harus diisi!',
            'name.max'              => 'Maksimal 255 karakter!',
            'username.max'          => 'Maksimal 255 karakter!',
            'username.unique'       => 'Username telah digunakan oleh akun lain!',
            'password.max'          => 'Maksimal 255 karakter!',
            'username.min'          => 'Minimal 5 karakter!',
            'password.min'          => 'Minimal 5 karakter!',
            'password.confirmed'    => 'Password dan Password konfirmasi tidak sama!',
            'levels.required'       => 'Level harus dipilih!',
            'levels.min'            => 'Level harus dipilih!',
            'is_active.required'    => 'Status harus diisi!',
            'is_active.boolean'     => 'Status hanya boleh diisi aktif / tidak aktif!'
        ]);

        $otherUser = User::where('username', $request->username)->withTrashed()->first();
        if ($otherUser) {
            if ($otherUser->deleted_at) {
                return back()->withInput()->withError('Username telah digunakan oleh akun lain yang telah dihapus!');
            }
            return back()->withInput()->withError('Username telah digunakan oleh akun lain!');
        }

        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'password'  => bcrypt($request->password),
            'is_active' => true,
            'levels'    => $request->levels,
        ]);


        return redirect()->route('mgt.user.index')->withSuccess('Pengguna berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        abort_if(!$user, 400, 'Pengguna tidak ditemukan');

        return view('management.user.edit', compact('user'));
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        abort_if(!$user, 400, 'Pengguna tidak ditemukan');

        $request->validate([
            'username' => 'required|alpha_num:ascii|min:5|max:255',
            'password' => 'nullable|confirmed|min:5|max:255',
            'is_active' => 'required|boolean',
            'levels' => 'required|min:1',
        ], [
            'username.required' => 'Username harus diisi!',
            'username.max' => 'Maksimal 255 karakter!',
            'username.alpha_num'    => 'Username hanya boleh diisi karakter A-Z a-z 0-9!',
            'password.max' => 'Maksimal 255 karakter!',
            'username.min' => 'Minimal 5 karakter!',
            'password.min' => 'Minimal 5 karakter!',
            'password.confirmed' => 'Password dan Password konfirmasi tidak sama!',
            'is_active.request' => 'Status harus diisi!',
            'is_active.boolean' => 'Status hanya boleh diisi aktif / tidak aktif!',
            'levels.required'       => 'Level harus dipilih!',
            'levels.min'            => 'Level harus dipilih!',
        ]);

        $otherUser = User::where('username', $request->username)->where('id', '!=', $user->id)->withTrashed()->first();
        if ($otherUser) {
            if ($otherUser->deleted_at) {
                return back()->withInput()->withError('Username telah digunakan oleh akun lain yang telah dihapus!');
            }
            return back()->withInput()->withError('Username telah digunakan oleh akun lain!');
        }

        $user->is_active = $request->is_active;
        $user->username = $request->username;
        $user->name = $request->name;
        $user->levels = $request->levels;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('mgt.user.index')->withSuccess('Pengguna berhasil diubah!');
    }

    public function activate($id)
    {
        $user = User::find($id);
        abort_if(!$user, 400, 'Pengguna tidak ditemukan');

        $user->is_active = true;
        $user->save();

        return redirect()->route('mgt.user.index', ['view'=>'active'])->withSuccess('Pengguna berhasil diaktifkan!');
    }

    public function inactivate($id)
    {
        $user = User::find($id);
        abort_if(!$user, 400, 'Pengguna tidak ditemukan');

        $user->is_active = false;
        $user->save();

        return redirect()->route('mgt.user.index', ['view'=>'inactive'])->withSuccess('Pengguna berhasil dinonaktifkan!');
    }

    public function remove($id)
    {
        $user = User::find($id);
        abort_if(!$user, 400, 'Pengguna tidak ditemukan');

        $user->delete();

        return redirect()->route('mgt.user.index', ['view' => 'inactive'])->withSuccess('Pengguna berhasil dihapus!');
    }
}
