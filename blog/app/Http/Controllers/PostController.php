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
        $returnData = [];
        foreach ($posts as $post) {
            $returnData[] = [
                'id' => $post->id,
                'title' => $post->title,
                'cover' => $post->cover,
                'createdAt' => $post->created_at,
                'authorName' => $post->author->name,
            ];
        }

        return response()->json($posts);
    }
}
