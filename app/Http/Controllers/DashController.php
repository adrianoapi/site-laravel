<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        return view('indexDash');
    }

    public function list()
    {
        die('dashboard');
    }
}
