
@extends('layouts.app')

@section('content')
    <div>
        <a class="back-link" href="{{ url()->previous() ?: route('home') }}">&larr; Voltar</a>
    </div>
    <section class="posts">
        <article class="post-card">
            <h3 class="post-title">{{ $post->title }}</h3>
            <div class="post-meta">
                Author: <strong>{{ $post->user->name }}</strong>
                •
                Category: <strong>{{ optional($post->category)->title ?? 'Todos' }}</strong>
                <span class="post-date">Data: {{ $post->created_at->format('d/m/Y')  }}</span>
            </div>
             <img src="{{asset('storage/posts/'.$post->image)}}" alt="" width="100%" height="250px">
             <br>
            <p class="post-body">{{ $post->text }}</p>
        </article>
    </section>
@endsection