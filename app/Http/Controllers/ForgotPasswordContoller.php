<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordContoller extends Controller
{
    public function forgotPass()
    {
        return view('forgotPass');
    }

    public function forgotPassOtp()
    {
        return view('forgotPassOtp');
    }

    public function sendOtp(Request $request)
    {
        // Validasi email yang dikirimkan
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Cari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Generate OTP (6-digit angka)
        $otp = mt_rand(100000, 999999);

        // Set OTP dan tanggal kadaluarsa (misalnya, 10 menit)
        $user->otp = $otp;
        $user->otp_expiration = Carbon::now()->addMinutes(10);
        $user->save();

        // Kirim OTP ke email pengguna
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Your OTP Code');
        });

        // Redirect ke halaman OTP
        return redirect()->route('auth.forgotPassOtp')->with('success', 'OTP telah dikirim ke email Anda.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Compare the OTP from session and input
        if ($request->otp == session('otp')) {
            return redirect()->route('auth.resetPasswordForm');
        } else {
            return back()->with('error', 'Invalid OTP');
        }
    }
}
