<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category','author'])->paginate(10);

        return view('home/index', compact('posts'));
    }
}
