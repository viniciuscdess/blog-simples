
@extends('layouts.app')

@section('content')
    <div>
        <a class="back-link" href="{{ url()->previous() ?: route('home') }}">&larr; Voltar</a>
    </div>

    <section class="posts">
        <article class="post-card">
            <h2 class="post-title">Editar Postagem</h2>

            <form action="{{route('posts.update')}}" method="POST" class="form-stack">
                @csrf
                @method('PUT')

                <label for="title" class="field-label">Título</label>
                <input id="title" name="title" type="text" class="field-input" value="{{ old('title', $post->title ?? '') }}">
                @error('title') <div style="color:red">{{ $message }}</div> @enderror


                <label for="text" class="field-label">Texto</label>
                <textarea name="text" id="text" cols="30" rows="10" class="field-input">{{ old('title', $post->text ?? '') }}</textarea>
                @error('text') <div style="color:red">{{ $message }}</div> @enderror

                <label for="category" class="field-label">Categoria</label>
                <select name="category_id" id="category" class="field-input">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{ ($category->id == $post->category_id) ? 'selected' : ""}}>
                            {{$category->title}}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="id_post" id="id_post" value="{{$post->id}}">

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Editar</button>
                    <a href="{{ route('posts.index') }}" class="action-link">Cancelar</a>
                </div>
            </form>

        </article>
    </section>
@endsection