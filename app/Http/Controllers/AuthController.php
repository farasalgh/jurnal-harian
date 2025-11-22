<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginForm()
    {
        //
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        //
        $crendentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt($crendentials)) {
            $user = Auth::user();
            $role = $user->role;

            if ($role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($role == 'pembimbing') {
                return redirect()->route('pembimbing.dashboard');
            } else if ($role == 'siswa') {
                return redirect()->route('siswa.dashboard');
            } else if ($role == 'pembimbingDudi') {
                return redirect()->route('pembimbingDudi.dashboard');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'role tidak ditemukan');
            }
        } else {
            return redirect()->back()->withErrors([
                'email'=> 'email, atau password salah',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
