<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c1= new Comment;
        $c1->content = "This is a comment";
        $c1->likes = 10;
        $c1->user_id = 1;
        $c1-> post_id = 1;
        $c1-> likes();
        $c1->save();

        Comment::factory()->count(10)->create();
    }
}
