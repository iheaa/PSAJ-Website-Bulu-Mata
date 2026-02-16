<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show Sign In Form
    public function showSignIn()
    {
        return view('signin');
    }

    // Show Sign Up Form
    public function showSignUp()
    {
        return view('signup');
    }

    // Handle Sign Up logic
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min' => 'Password harus lebih dari 8 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'email.unique' => 'Email ini sudah terdaftar.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Account created successfully!');
    }

    // Handle Sign In logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'Password anda telah salah!',
        ])->onlyInput('email');
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}