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

public function updateProfile(Request $request)
{
    // dd($request->all());
    $user = Auth::user();

    $request->validate([
        'password' => 'nullable|min:6'
    ]);
    $imagePath = $request->file('profile_picture');
    $path = $imagePath->storeAs('users',$imagePath->hashName(),'public');
    

    $user->name = $request->nama_lengkap;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->profile_picture = $path;
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

  $user->save();
    return redirect()->back()->with('success', 'Profil berhasil diperbarui');
}


}
