<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function about()
    {
         return view('pages.admin.about.about');
    }
        public function aboutme()
    {
         return view('pages.admin.about.about-me');
    }
    public function login()
    {
        return view('pages.auth.login-form');
    }
        public function register()
    {
        return view('pages.auth.register-form');
    }

    public function authentication(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            session(['last_login' => now()]);
            return redirect()->route('jenis_penggunaan.index')->with('success', 'Selamat datang kembali!');
        }else{
            redirect()->back()->with('error', 'Password atau Email salah!');
        }
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $data['name']                  = $request->name;
        $data['email']                 = $request->email;
        $data['password']              = Hash::make($request->password);
        $data['password_confirmation'] = $request->password_confirmation;

        User::create($data);

        return redirect()->route('login')->with('success', 'Registrasi Berhasil!');
    }
    function logout(Request $request)
    {
	Auth::logout();
    $request->session()->invalidate();     // Hapus semua session
    $request->session()->regenerateToken(); // Cegah CSRF
    return redirect()->route('login');
    }

}
