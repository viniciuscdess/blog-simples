<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $posts = Post::with(['category','user'])->where('user_id', "=", $user->id)->orderBy('created_at', 'desc')->paginate(10);

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
        $categories = Category::all();
        
        return view('posts/create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'text' => 'required|min:3',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $user = auth()->user();

        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;   
        $post->user_id = $user->id;   
        $post->category_id = $request->category_id;   
        $post->slug =  $user->id . '-' . str_replace(' ', '-' ,$request->title);
        $post->save();


        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }
}
