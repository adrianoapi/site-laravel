<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $post = new Post();
        #$post->create($request->except('_token'));
        $post->title    = $request->title;
        $post->subtitle = $request->subtitle;
        $post->content  = $request->content;
        $post->user_id  = 1;
        $post->save();

        return \redirect()->route('posts.index');
    }

    public function index()
    {
        $posts = DB::table('posts')->paginate(10);
        
        return view('listAllPosts', ['posts' => $posts]);
    }

    public function create()
    {
        return view('addPost');
    }

    public function show(Post $post)
    {
        echo '<h1>Artigo</h1>';
        if($post)
        {
            echo "<p>#{$post->id}, {$post->title}, {$post->content}</p>";
        }

        $user = $post->author->first();
        if($user){
            echo '<h1>Author</h1>';
            echo $user->name;
        }

        $categoreis = $post->categories()->get();

        if($categoreis){
            echo '<h1>Categorias</h1>';
            foreach($categoreis as $category):
                echo "<p>#{$category->id}, {$category->title}</p>";
            endforeach;
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return \redirect()->route('posts.index');
    }
}
