<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    
    public function newPassword()
    {
        return view('newPassword');
    }
}
