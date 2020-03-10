<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard()
    {
        if(Auth::check() === true){
            return view('admin.dashboard');
        }else{
            return \redirect()->route('admin.login');
        }
    }

    public function showLoginForm()
    {
        return view('admin.formLogin');
    }

    public function login(Request $request)
    {
        var_dump(Auth::attempt(['email' => $request->email, 'password' => $request->password]));
    }

    public function logout()
    {
        Auth::logout();
        return \redirect()->route('admin');
    }
}
