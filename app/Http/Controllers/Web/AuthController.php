<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('front.auth.login');
    }

    public function showRegisterForm()
    {
        return view('front.auth.register');
    }
}
