<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }

    public function register(Request $request)
    {
        return view('register');
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password)
        ]);

        return redirect('/login')->with('message', 'Register berhasil');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

       $credentials = $request->only('username', 'password');

       if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
       }

       return back()->withErrors([
           'error' => 'Username atau password anda salah!'
       ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('message', 'Logout berhasil');
    }
}
