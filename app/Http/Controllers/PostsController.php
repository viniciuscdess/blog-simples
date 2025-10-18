<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')){
            $file = $request->file('image');
            
            $filename = time() . '-' . $file->getClientOriginalName();
            
            $path = $file->storeAs('posts', $filename, 'public');
        } 

        $user = auth()->user();

        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;   
        $post->user_id = $user->id;   
        $post->category_id = $request->category_id;   
        $post->slug =   $this->makeSlug($request->title, $user->id);
        
        $post->image = $filename ?: null;
       
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    public function edit($slug, $id)
    {
        $user = auth()->user(); 

        if (!$slug || strlen($slug) < 3) redirect()->back(); 

        if (!$id || $user->id !== $id) redirect()->back(); 

        $post =  Post::with(['category','user'])->where('slug', "=", $slug)->firstOrFail();
        
        $categories = Category::all();

        return view('posts/edit', compact('post','categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'text' => 'required|min:3',
            'category_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('image')){
            $file = $request->file('image');
            
            $filename = time() . '-' . $file->getClientOriginalName();
            
            $path = $file->storeAs('posts', $filename, 'public');
        } 

        // isso aqui ja verifica se é o usuario criador
        $post = $user->posts()->where('id', $request->id_post)->firstOrFail();
        $post->title = $request->title;
        $post->text = $request->text;   
        $post->category_id = $request->category_id;   
        $post->slug =   $this->makeSlug($request->title, $user->id);

        $post->image = $filename ?: $post->image;

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post editado com sucesso!');
    }

    private function makeSlug($title, $userId)
    {
        return $userId . '-' . str_replace(' ', '-' ,$title);
    }

    public function delete(Post $post)
    {
        $user = auth()->user();

        if ($post->id_user !== $user->id) redirect()->back(); 

        $post->delete();
        
        return redirect()->route('posts.index'); 
    }
}
