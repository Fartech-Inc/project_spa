<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Model
use App\Models\User;

// Helper
use App\Helper\InputValidationHelper;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }

    public function login_process(Request $request){
        $validation = [
            'email'=> 'required|email',
            'password' => 'required|string',
        ];
        $message = [
            'required' => ':attribute tidak boleh kosong',
            'email' => ':attribute harus berupa email',
        ];
        $names = [
            'email' => 'Email',
            'password' => 'Password',
        ];
        $validator = Validator::make($request->all(), $validation, $message, $names);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $email = InputValidationHelper::validate_input_email($request->email);
            if (!$email) {
                return redirect()
                    ->back()
                    ->with('error', 'Email tidak valid')
                    ->withInput();
            }

            // check user use email
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect()
                    ->back()
                    ->withErrors(['email' => 'Email tidak terdaftar'])
                    ->withInput();
            }

            // if user found, check password
            if (!Hash::check($request->password, $user->password)) {
                return redirect()
                    ->back()
                    ->with('error', 'Password salah')
                    ->withInput();
            }

            // Authenticate user
            if (Auth::attempt(['email' => $email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()
                ->route('home')
                ->with('success', 'Login berhasil');
            }

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function register(Request $request)
    {
        return view('register');
    }

    public function register_process(Request $request){
        $now = date('Y-m-d');
        // validation
        $validation = [
            'email'=> 'required|email|unique:users,email',
            'name' => 'required|string',
            'phone' => 'required|string',
            'bod' => 'required|date|before:'.$now,
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:8',                                // must be at least 8 characters in length
                'regex:/[a-z]/',                        // must contain at least one lowercase letter
                'regex:/[A-Z]/',                        // must contain at least one uppercase letter
                'regex:/[0-9]/',                        // must contain at least one digit numeric
                'regex:/[?!@#$%^&*~`_+=:;.,"><\'-]/',   // must contain a special character
            ],
        ];
        $message = [
            'required' => ':attribute tidak boleh kosong',
            'email' => ':attribute harus berupa email',
            'date' => ':attribute harus berupa tanggal',
            'min' => ':attribute minimal :min karakter',
            'confirmed' => 'Konfirmasi :attribute tidak cocok',
            'regex' => ':attribute harus mengandung huruf kecil, huruf besar, angka, dan karakter spesial',
            'unique' => ':attribute sudah terdaftar',
            'before' => ':attribute harus sebelum tanggal sekarang',
        ];
        $names = [
            'email' => 'Email',
            'name'=> 'Nama',
            'phone'=> 'Nomor Telepon',
            'bod'=> 'Tanggal Lahir',
            'password' => 'Password',
        ];
        $validator = Validator::make($request->all(), $validation, $message, $names);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // DB Transaction
        DB::beginTransaction();
        try {
            $email = InputValidationHelper::validate_input_email($request->email);
            if (!$email) {
                return redirect()
                    ->back()
                    ->with('error', 'Email tidak valid')
                    ->withInput();
            }   

            $name = InputValidationHelper::validate_input_text($request->name);
            if (!$name) {
                return redirect()
                    ->back()
                    ->with('error', 'Nama tidak valid')
                    ->withInput();
            }
            
            $phone = InputValidationHelper::validate_input_text($request->phone);
            if (!$phone) {
                return redirect()
                    ->back()
                    ->with('error', 'Nomor Telepon tidak valid')
                    ->withInput();
            }      
            
            $bod = InputValidationHelper::validate_input_text($request->bod);
            if (!$bod) {
                return redirect()
                    ->back()
                    ->with('error', 'Tanggal Lahir tidak valid')
                    ->withInput();
            }

            $password = Hash::make($request->password);

            // Create User
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->phone = $phone;
            $user->bod = $bod;
            $user->password = $password;
            $user->save();

            DB::commit();

            // return response success
            return redirect()
                ->route('auth.login')
                ->with('success', 'Registrasi berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    public function logout(Request $request){
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()
                ->route('auth.login')
                ->with('success', 'Logout berhasil');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat logout: ' . $e->getMessage());
        }
    }
}
