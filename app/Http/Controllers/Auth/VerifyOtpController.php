<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyOtpController extends Controller
{
    public function verifyOpt(){
        return view('auth.otp');
    }
}
