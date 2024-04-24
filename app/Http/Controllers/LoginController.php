<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function registers(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',  // Memastikan email unik dalam tabel 'users'
            'password' => 'required',
        ]);

        // Membuat dan menyimpan user baru
        $user = new User();
        $user->email = $request->email;
        $user->role = '2';
        $user->password = Hash::make($request->password);  // Menggunakan Hash untuk mengamankan password
        $user->save();

        // Redirect ke halaman awal
        return redirect('logins')->with('success', 'User registered successfully.');
    }
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->role == '1') {
                return redirect()->intended('dashboard');
            } elseif ($user->role == '2') {
                return redirect()->intended('biodata');
            }
        }
        return view('auth.login', [
            'title' => "Login"
        ]);
    }

    public function proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $kredensial = $request->only('email', 'password');

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role == '1') {
                return redirect()->intended('dashboard');
            } elseif ($user->role == '2') {
                return redirect()->intended('dashboard');
            }
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'email or password incorect',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
