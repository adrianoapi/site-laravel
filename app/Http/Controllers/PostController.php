<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showForm()
    {
        return view('addPost');
    }

    public function debug(Request $request)
    {
        $post = new Post();
        #$post->create($request->except('_token'));
        $post->title    = $request->title;
        $post->subtitle = $request->subtitle;
        $post->content  = $request->content;
        $post->user_id  = 1;
        $post->save();
    }
}
