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

    public function newPasswordForm()
    {
        return view('newPassword');
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

        // Simpan email ke session
        session(['reset_email' => $user->email]);

        // Redirect ke halaman OTP
        return redirect()->route('auth.forgotPassOtp')->with('success', 'OTP telah dikirim ke email Anda.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'numeric|digits:1',
        ]);

        // Gabungkan OTP menjadi satu string
        $otp = implode('', $request->otp);

        // Cari user berdasarkan OTP
        $user = User::where('otp', $otp)
            ->where('otp_expiration', '>', Carbon::now())
            ->first();

        if ($user) {
            // Set email di session
            session(['reset_email' => $user->email]);

            // Hapus OTP setelah digunakan
            $user->otp = null;
            $user->otp_expiration = null;
            $user->save();

            return redirect()->route('auth.newPasswordForm')->with('success', 'OTP valid, silakan reset password Anda.');
        } else {
            return back()->with('error', 'OTP salah atau telah kadaluarsa.');
        }
    }

    public function resendOtp(Request $request)
    {
        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('auth.forgotPass')->with('error', 'Sesi tidak ditemukan. Silakan masukkan email Anda kembali.');
        }

        // Cari user berdasarkan email dari session
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('auth.forgotPass')->with('error', 'User tidak ditemukan.');
        }

        // Generate OTP baru
        $otp = mt_rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expiration = Carbon::now()->addMinutes(10);
        $user->save();

        // Kirim ulang OTP ke email
        Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Resend OTP Code');
        });

        return redirect()->route('auth.forgotPassOtp')->with('success', 'OTP baru telah dikirim ulang ke email Anda.');
    }


    public function newPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('auth.login')->with('success', 'Password berhasil direset. Silakan login.');
    }
}
