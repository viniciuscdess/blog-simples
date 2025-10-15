<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Pessoal</title>
    {{-- Vite assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="topbar">
        <div class="container">
            <h1 class="brand">Blog Pessoal</h1>

            <nav class="menu" aria-label="Main Navigation">
                <ul>
                    <li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ route('home.index') }}">Dashboard</a></li>
                    <li class="{{ request()->is('profile') ? 'active' : '' }}"><a href="{{route('profile.index')}}">Perfil</a></li>
                    <li class="{{ request()->is('posts') ? 'active' : '' }}"><a href="{{ route('posts.index') }}">Meus posts</a></li>
                </ul>
            </nav>

            <form class="logout" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Sair</button>
            </form>
        </div>
    </header>

    <main class="container main-content">
        @yield('content')
    </main>
</body>
</html>
