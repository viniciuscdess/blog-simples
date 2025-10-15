
@extends('layouts.app')

@section('content')
    <section class="posts">
        <article class="post-card">
            <h2 class="post-title">Meu Perfil</h2>
            <div class="post-meta">Atualize seus dados abaixo</div>

            <form action="{{route('profile.update')}}" method="POST" class="form-stack">
                @csrf
                @method('PUT')

                <label for="name" class="field-label">Nome</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name ?? '') }}" class="field-input">
                @error('name') <div style="color:red">{{ $message }}</div> @enderror

                <label for="email" class="field-label">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="field-input">
                @error('email') <div style="color:red">{{ $message }}</div> @enderror

                <label for="password" class="field-label">Senha</label>
                <input id="password" name="password" type="password" placeholder="Deixe em branco para manter a senha atual" class="field-input">
                @error('password') <div style="color:red">{{ $message }}</div> @enderror

                <label for="password_confirmation" class="field-label">Confirmar senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="field-input">
                @error('password_confirmation') <div style="color:red">{{ $message }}</div> @enderror
                
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('home.index') }}" class="action-link">Cancelar</a>
                </div>
            </form>

        </article>
    </section>
@endsection