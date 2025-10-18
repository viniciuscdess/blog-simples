
@extends('layouts.app')

@section('content')
    @forelse($posts as $post)
        <section class="posts">
            <article class="post-card">
                <h3 class="post-title"><a href="{{route('posts.view', ['slug'=> $post->slug])}}">{{ $post->title }}</a></h3>
                <div class="post-meta">
                    Author: <strong>{{ $post->user->name }}</strong>
                    •
                    Category: <strong>{{ optional($post->category)->title ?? 'Todos' }}</strong>
                    <span class="post-date">Data: {{ $post->created_at->format('d/m/Y')  }}</span>
                </div>
                <img src="{{asset('storage/posts/'.$post->image)}}" alt="" width="100%" height="200px">
                <p class="post-body">{{ substr($post->text, 0, 80) }} ...</p>
            </article>
        </section>
    @empty
        <p>Nenhum post encontrado.</p>
    @endforelse

    <div class="pagination-wrap">
        {{ $posts->links() }}
    </div>
@endsection