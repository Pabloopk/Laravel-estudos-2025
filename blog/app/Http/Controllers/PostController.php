<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function getPosts(Request $request)
    {
        // Logic to retrieve posts
        // For example, you might fetch posts from a Post model
        $posts = \App\Models\Post::all();

        return response()->json($posts);
    }
}
