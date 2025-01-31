<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|max:255',
            'password' => 'required|max:255',
        ],[
            'username.required' => 'Username harus diisi!',
            'username.max' => 'Username maksimal 255 karakter!',
            'password.required' => 'Password harus diisi!',
            'password.max' => 'Password maksimal 255 karakter!',
        ]);

        // Cek user dengan username aktif
        $user = User::where('username', $request->username)
            ->where('is_active', true)
            ->first();

        // Validasi username atau password salah
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->route('login')
                ->withInput($request->only('username')) // Mengembalikan username yang diinput
                ->with('error', 'Username atau Password tidak sesuai!');
        }

        // Login user
        Auth::loginUsingId($user->id);

        // Redirect dengan pesan sukses
        return redirect()->intended('managements/dashboard')
            ->withSuccess("Selamat Datang, {$user->name}!");
    }


    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
