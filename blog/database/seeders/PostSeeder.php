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
            'title' => 'Sample Post',
            'slug' => 'sample-post',
            'content' => 'This is a sample post content.',
            'cover' => 'sample-cover.jpg',
            'status' => 'published',
            'authorId' => 1, // Assuming user with ID 1 exists
        ]);
    }
}
