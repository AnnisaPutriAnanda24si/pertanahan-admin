<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index() //Menampilkan view login-form

    {
        return view('login-form');
    }
public function login(Request $request) //Menerima dan memproses data form login
{
    $username = 'Annisa';
    $password = 'Annisa123';

    $data['username'] = $request->username;
    $data['password'] = $request->password;

    $request->validate([
        'username' => ['required'],
        'password' => ['required','min:3','regex:/[A-Z]/']
    ],
    [
        'username.required' => 'Username wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'password.min'      => 'Password minimal 3 karakter.',
        'password.regex'    => 'Password harus mengandung huruf kapital.',
    ]);

    if ($request->username === $username && $request->password === $password) {
        return view('logged', $data);
    } else {
        return redirect()->back()->withErrors([
            'loginError' => 'Username atau password salah.'
        ])->withInput();
    }
}

}
