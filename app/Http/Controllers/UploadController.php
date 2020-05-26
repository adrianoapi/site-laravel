<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function upload(Request $request)
    {
        $request->file('arquivo')->store('ok');
        //var_dump($request->file('arquivo'));
    }
}
