
@extends('layouts.app')

@section('content')
    <div class="list-header">
        <h2 style="margin:0">Meus posts</h2>
        <a class="btn btn-primary add-post" href="{{ route('posts.create') }}">+ Adicionar</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

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
                <div class="post-meta actions">
                   <span>
                       <a class="action-link edit-link" href="{{ route('posts.edit', ['slug' => $post->slug, 'id' => $post->user_id]) }}">Editar</a>
                   </span>

                   <span>
                       <form class="inline-delete" action="{{ route('posts.delete', ['post' => $post->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este post?');">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="action-link delete-link">Deletar</button>
                       </form>
                   </span>
                </div>
                
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