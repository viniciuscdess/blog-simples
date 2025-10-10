<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category','user'])->orderBy('created_at', 'desc')->paginate(10);

        return view('home/index', compact('posts'));
    }

    public function myPosts()
    {
        $user = auth()->user();

        $posts = Post::with(['category','user'])->where('id', "=", $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('posts/index', compact('posts'));
    }

    public function view($slug)
    {
        if (!$slug || strlen($slug) < 3) redirect()->back();

        // ao invés de usar o first ele usa esse firstorfail pra estourar um erro 404 caso não encontre o post
        $post = Post::with(['category','user'])->where('slug', "=", $slug)->firstOrFail();

        return view('posts/view', compact('post'));
    }

    public function create()
    {
        return view('posts/create');
    }
}
