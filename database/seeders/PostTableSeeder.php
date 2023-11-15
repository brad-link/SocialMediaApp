<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p1 = new Post;
        $p1->user_id = 2;
        $p1->content = "This is the content";
        $p1->likes = 10;
        $p1->save();

        Post::factory()->count(10)->create();
        $post = Post::factory()
                ->has(Comment::factory()->count(5))
                ->create();
    }
}
