<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetCodeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email yang Anda masukkan tidak terdaftar.',
        ]);

        $email = $request->email;
        $otp = sprintf("%06d", mt_rand(1, 999999));

        // Insert or update OTP in password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp,
                'created_at' => now(),
            ]
        );

        // Send Email
        Mail::to($email)->send(new ResetPasswordMail($otp));

        return redirect()->route('password.verify.form')->with('email', $email)->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }

    public function showVerifyCodeForm(Request $request)
    {
        $email = session('email', $request->query('email'));
        if (!$email) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-code', compact('email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|numeric|digits:6',
        ]);

        $resetData = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (!$resetData || $resetData->token !== $request->code) {
            return back()->with('error', 'Kode OTP salah atau tidak ditemukan.')->withInput();
        }

        // Check expiry (e.g., 15 minutes)
        if (now()->subMinutes(15)->gt($resetData->created_at)) {
            return back()->with('error', 'Kode OTP telah kedaluwarsa. Silakan minta kode baru.')->withInput();
        }

        // OTP is valid. Store email in session to allow reset
        session(['reset_email' => $request->email]);

        return redirect()->route('password.reset.form')->with('success', 'Kode OTP berhasil diverifikasi.');
    }

    public function showResetPasswordForm()
    {
        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('password.request')->with('error', 'Permintaan Anda tidak sah. Silakan mulai ulang.');
        }

        return view('auth.reset-password', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ], [
            'password.min' => 'Password harus minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $email = session('reset_email');

        if ($email !== $request->email) {
            return redirect()->route('password.request')->with('error', 'Data tidak valid.');
        }

        // Update password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Clear token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Clear session
        session()->forget('reset_email');

        return redirect()->route('signin')->with('success', 'Password Anda berhasil diubah. Silakan login kembali.');
    }
}
