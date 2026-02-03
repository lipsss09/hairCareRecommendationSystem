<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{


public function showLogin() {
    return view('auth.login');
}

public function showRegister() {
    return view('auth.register');
}

public function register(Request $request) {

    $request->validate([
        'nama_lengkap' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed'
    ]);

    $user =User::create([
        'name' => $request->nama_lengkap,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);

    return redirect('/login')->with('success', 'Akun berhasil dibuat');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // penting biar aman
        return redirect('/dashboard');
    }

    return back()->with('error', 'Email atau password salah');
}
public function logout() {
    Auth::logout();
    return redirect('/login');
}

public function updateProfile(Request $request) {
    $user = Auth::user();

    $request->validate([
        'nama_lengkap' => 'required',
        'username' => 'required|unique:users,username,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed'
    ]);

   $data = [
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);


    return redirect()->back()->with('success', 'Profil berhasil diperbarui');

}

}
