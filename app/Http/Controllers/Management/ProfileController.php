<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view(
            'profile.index', 
            compact('user')
        );
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password' => 'required|confirmed|min:5|max:255',
            'old_password' => 'required|max:255',
        ], [
            'password.max' => 'Maksimal 255 karakter!',
            'password.min' => 'Minimal 5 karakter!',
            'password.confirmed' => 'Password dan Password konfirmasi tidak sama!',
            'old_password.required' => 'Password harus diisi!',
            'old_password.required_with' => 'Password lama harus diisi!',
            'old_password.max' => 'Password lama maksimal 255 karakter!',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withError('Password lama tidak sesuai!');
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('mgt.profile.index')->withSuccess('Password berhasil diubah!');
    }
}
