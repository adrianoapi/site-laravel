<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function getCollection()
    {
        $users = auth('api')->user();

        $collections = \App\Collection::where('user_id', $users->id)->orderBy('title', 'asc')->get();
        return response()->json($collections);
    }


}
