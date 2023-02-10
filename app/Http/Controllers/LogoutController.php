<?php

namespace App\Http\Controllers;

use Auth;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        return redirect('/service/login');
    }
}
