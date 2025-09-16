<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function getPosts(Request $request) {
        $user = $request->user();
                $posts_per_page = 10;

        $posts = Post::where('authorId', $user->id)->paginate($posts_per_page);

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
                'status' => $post->status,
            ];
        }

        return [
            'pagesPosts' => $pagesPosts,
            'page' => $posts->currentPage(),

        ];

    }
}
