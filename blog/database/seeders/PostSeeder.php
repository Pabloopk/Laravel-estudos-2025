<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $post1 = Post::create([
            'title' => 'Post 1',
            'slug' => 'slug-teste',
            'body' => 'This is a sample post content.',
            'cover' => 'sample-cover.jpg',
            'status' => 'published',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);
        $post1->tags()->attach([1, 2]); // Attach tags to the first post
        $post2 = Post::create([
            'title' => 'Post 2',
            'slug' => 'slug2-teste',
            'body' => 'This is a sample post2 content.',
            'cover' => 'sample-cover.jpg',
            'status' => 'published',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);
        $post2->tags()->attach([1, 3]); // Attach tags to the second post
        $post3 = Post::create([
            'title' => 'Post 3',
            'slug' => 'slug3-teste',
            'body' => 'This is a sample post3 content.',
            'cover' => 'https://picsum.photos/200/300',
            'status' => 'DRAFT',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);

        $post3->tags()->attach([1, 3]); // Attach tags to the third post
        $post4 = Post::create([
            'title' => 'Post 4',
            'slug' => 'slug4-teste',
            'body' => 'This is a sample post4 content.',
            'cover' => 'sample-cover.jpg',
            'status' => 'published',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);

        $post4->tags()->attach([1, 2, 3, 4]); // Attach tags to the fourth post
    }
}
