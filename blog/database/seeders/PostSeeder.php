<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Post::create([
            'title' => 'Post 1',
            'slug' => 'slug-teste',
            'body' => 'This is a sample post content.',
            'cover' => 'sample-cover.jpg',
            'status' => 'published',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);
        Post::create([
            'title' => 'Post 2',
            'slug' => 'slug-teste',
            'body' => 'This is a sample post2 content.',
            'cover' => 'sample-cover.jpg',
            'status' => 'published',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);
        Post::create([
            'title' => 'Post 3',
            'slug' => 'slug-teste',
            'body' => 'This is a sample post3 content.',
            'cover' => 'sample-cover.jpg',
            'status' => 'published',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);
        Post::create([
            'title' => 'Post 4',
            'slug' => 'slug-teste',
            'body' => 'This is a sample post4 content.',
            'cover' => 'sample-cover.jpg',
            'status' => 'published',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);
    }
}
