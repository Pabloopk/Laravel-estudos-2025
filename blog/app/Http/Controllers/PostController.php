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
        $posts_per_page = 2;

        $posts = \App\Models\Post::paginate($posts_per_page);
        $pagesPosts = [];
        foreach ($posts as $post) {
            $pagesPosts[] = [
                'id' => $post->id,
                'title' => $post->title,
                'cover' => $post->cover,
                'createdAt' => $post->created_at,
                'authorName' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'body' => $post->body,
                'slug' => $post->slug,
            ];
        }

        return [
            'pagesPosts' => $pagesPosts,
            'page' => $posts->currentPage(),

        ];


    }
}
