
@extends('layouts.app')

@section('content')
    <div>
        <a class="back-link" href="{{ url()->previous() ?: route('home') }}">&larr; Voltar</a>
    </div>

    <section class="posts">
        <article class="post-card">
            <h2 class="post-title">Criar Postagem</h2>

            <form action="{{route('posts.store')}}" method="POST" class="form-stack">
                @csrf

                <label for="title" class="field-label">Título</label>
                <input id="title" name="title" type="text" class="field-input">

                <label for="title" class="field-label">Texto</label>
                <textarea name="text" id="text" cols="30" rows="10" class="field-input"></textarea>

                <label for="category" class="field-label">Categoria</label>
                <select name="category_id" id="category" class="field-input">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('posts.index') }}" class="action-link">Cancelar</a>
                </div>
            </form>

        </article>
    </section>
@endsection