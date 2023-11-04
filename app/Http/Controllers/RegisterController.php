<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'title' => 'Perpus | Daftar'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'username' => ['required', 'unique:users', 'max:20', 'min:4'],
            'name' => ['required', 'unique:users', 'max:100'],
            'password' => ['required', 'min:8'],
            'prof_pic' => ['required']
        ]);
        // password hash
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        // succes
        return redirect('/')->with('success', '<strong>Akun berhasil dibuat!</strong> <br>Silahkan masuk terlebih dahulu');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('successLogout', 'Anda telah keluar!');
    }
}
