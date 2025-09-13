<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function getPosts(Request $request)
    {
        // Logic to retrieve posts
        // For example, you might fetch posts from a Post model
        $posts_per_page = 10;

        $posts = Post::where('status', 'PUBLISHED')->paginate($posts_per_page);
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

    public function getPost(string $slug)
    {
        // Logic to retrieve a single post by slug
       $post = Post::where(['slug' => $slug, 'status' => 'PUBLISHED'])->first();

        if (!$post) {
            return response()->json(['error' => '404 not found'], 404);
        }

        return [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'cover' => $post->cover,
                'createdAt' => $post->created_at,
                'authorName' => $post->author->name,
                'tags' => $post->tags->implode('name', ', '),
                'body' => $post->body,
                'slug' => $post->slug,
            ]
        ];
    }

   public function getRelatedPosts(string $slug)
{
    // 1) Busca o post pelo slug
    $post = Post::where(['slug' => $slug, 'status' => 'PUBLISHED'])->first();

    // 2) Se não existir, 404
    if (!$post) {
        return response()->json(['error' => '404 not found'], 404);
    }

    // 3) Pega os IDs das tags do post
    $tagsList = $post->tags->pluck('id');

    // 4) Busca posts que compartilham alguma das mesmas tags,

    $relatedPosts = Post::where('id', '!=', $post->id)
        ->whereHas('tags', function ($query) use ($tagsList) {
            $query->whereIn('tags.id', $tagsList)->where('posts.status', 'PUBLISHED');
        })
        ->limit(5)
        ->get();

        $returnPostData = [];

        foreach ($relatedPosts as $post) {
            $returnPostData[] = [
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

    // 5) Retorna como JSON (ou ajuste conforme sua necessidade)
    return response()->json([
        'posts' => $returnPostData
    ]);
}

}
