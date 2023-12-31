<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::orderBy("created_at","desc")->paginate(10);
        return view("posts.index", ['posts' => $posts]);
    }
}
