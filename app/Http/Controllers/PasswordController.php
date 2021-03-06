<?php

namespace App\Http\Controllers;

use App\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(array_key_exists('filtro',$_GET)){
            $passwords = Password::where('title', 'like', '%' . $_GET['pesquisar'] . '%')->orderBy('title', 'asc')->paginate(50);
        }else{
            $passwords = Password::orderBy('title', 'asc')->paginate(20);
        }
        return view('password.index', ['passwords' => $passwords]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addPassword');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = new Password();
        $password->user_id = Auth::id();
        $password->title   = $request->title;
        $password->login   = $request->login;
        $password->pass    = Crypt::encryptString($request->pass);
        $password->url     = $request->url;
        $password->save();

        return redirect()->route('passwords.index');
    }

    public function show(Request $request)
    {
        $password = Password::findOrFail($request->passowrd);
        $password->pass = Crypt::decryptString($password->pass);

        return response()->json([
            'body' => view('showPassword', compact('password'))->render(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function edit(Password $password)
    {
        $password->pass = Crypt::decryptString($password->pass);
        return \view('editPassword', ['password' => $password]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Password $password)
    {
        $password->title   = $request->title;
        $password->login   = $request->login;
        $password->pass    = Crypt::encryptString($request->pass);
        $password->url     = $request->url;
        $password->save();

        return \redirect()->route('passwords.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Password  $password
     * @return \Illuminate\Http\Response
     */
    public function destroy(Password $password)
    {
        $password->delete();
        return redirect()->route('passwords.index');
    }
}
