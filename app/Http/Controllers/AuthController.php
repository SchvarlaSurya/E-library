<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RonasIT\Clerk\Facades\Clerk;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $response = Clerk::authenticate($credentials);
            if ($response) {
                return redirect('/')->with('success', 'Selamat datang kembali!');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Email atau password salah.']);
        }
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ]);

        try {
            $user = Clerk::users()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email_address' => [$data['email']],
                'password' => $data['password'],
            ]);

            if ($user) {
                return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
            }
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal daftar: ' . $e->getMessage()]);
        }
    }

    public function logout()
    {
        Auth::guard('clerk')->logout();
        return redirect('/login');
    }
}