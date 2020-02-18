<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listUsers()
    {
        /*
        $user = new User();
        $user->name = 'Adriano A Costa';
        $user->email = 'adrianoapi@hotmail.com';
        $user->password = Hash::make('root');
        $user->save();
        echo 'oi';*/
        $user = User::where('id', 1)->first();
        //dd($user);
        return view('listUsers', ['user' => $user]);
    }

    public function listUser()
    {

    }
}
