<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboard()
    {
        if(Auth::check() === true){
            return redirect()->route('dash.index');
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
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return \redirect()->back()->withInput()->withErrors(['Email informado não é válido!']);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => true])){
            return \redirect()->route('admin');
        }
        
        return \redirect()->back()->withInput()->withErrors(['Dados informados não conferem!']);
    }

    public function logout()
    {
        Auth::logout();
        return \redirect()->route('admin');
    }
}
