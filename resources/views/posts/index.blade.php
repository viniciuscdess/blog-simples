
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
        /* Minimal white theme */
        html, body { height: 100%; }

        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            color: #0b1220; /* dark slate */
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 1rem;
        }

        .topbar {
            background: #ffffff;
            color: #0b1220;
            border-bottom: 1px solid rgba(11,18,32,0.06);
        }

        .topbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .brand {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0;
        }

        .menu ul {
            list-style: none;
            display: flex;
            gap: 1rem;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .menu a {
            color: #334155; /* slate-700 */
            text-decoration: none;
            padding: 0.35rem 0.5rem;
            border-radius: 6px;
            transition: background-color .12s ease, color .12s ease;
        }

        /* Active navigation item — darker background and white text */
        .menu li.active a,
        .menu a[aria-current="page"] {
            background: #0b1220; /* dark slate */
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(11,18,32,0.08);
        }

        /* Keep hover subtle for active item but slightly lighten for affordance */
        .menu li.active a:hover,
        .menu a[aria-current="page"]:hover {
            background: rgba(11,18,32,0.92);
            color: #ffffff;
        }

        .menu a:hover {
            background: rgba(15,23,42,0.03);
            color: #0b1220;
        }

        .logout button {
            background: transparent;
            color: #334155;
            border: 1px solid rgba(11,18,32,0.06);
            padding: 0.35rem 0.6rem;
            border-radius: 6px;
            cursor: pointer;
        }

        .main-content {
            padding: 2rem 1rem;
        }

        .post-card {
            background: #ffffff;
            border: 1px solid rgba(11,18,32,0.06);
            padding: 1.25rem;
            border-radius: 10px;
            color: #0b1220;
            max-width: 720px;
            margin: 0 auto;
            box-shadow: 0 6px 18px rgba(11,18,32,0.06);
        }

        .post-title { margin: 0 0 0.25rem 0; }
        .post-meta { color: #64748b; font-size: 0.9rem; margin-bottom: 0.75rem; }
        .post-body { margin: 0; line-height: 1.6; color: #0b1220; }

        /* Action links styling */
        .actions { display: flex; gap: 0.75rem; align-items: center; margin-top: 0.5rem; }
        .actions .action-link {
            display: inline-block;
            padding: 0.35rem 0.6rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            color: #334155;
            border: 1px solid rgba(11,18,32,0.06);
            background: transparent;
            cursor: pointer;
        }
        .actions .action-link:hover {
            background: rgba(15,23,42,0.03);
            color: #0b1220;
        }
        .actions .edit-link { }
        .actions .delete-link {
            color: #b91c1c; /* red-700 */
            border-color: rgba(185,28,28,0.08);
            background: rgba(185,28,28,0.03);
        }
        .actions .delete-link:hover {
            background: rgba(185,28,28,0.08);
            color: #7f1d1d;
        }

        /* Header and Add button */
        .list-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border: 1px solid rgba(11,18,32,0.08);
            cursor: pointer;
        }

        .btn-primary {
            background: #0b1220;
            color: #ffffff;
            border-color: rgba(11,18,32,0.12);
            box-shadow: 0 6px 18px rgba(11,18,32,0.06);
        }

        .btn-primary:hover {
            background: #0f1724;
        }

        .add-post { }

        @media (max-width: 640px) {
            .topbar .container { flex-direction: column; align-items: center; }
            .menu ul { flex-wrap: wrap; justify-content: center; }
        }

    </style>
</head>
<body>
    <header class="topbar">
        <div class="container">
            <h1 class="brand">Blog Pessoal</h1>

            <nav class="menu" aria-label="Main Navigation">
                <ul>
                    <li class="{{ request()->is('home') ? 'active' : '' }}"><a href="{{ route('home.index') }}">Dashboard</a></li>

                    <li class="{{ request()->is('profile') ? 'active' : '' }}"><a href="{{route('profile.index')}}">Perfil</a></li>

                    <li class="{{ request()->is('posts') ? 'active' : '' }}"><a href="posts">Meus posts</a></li>
                </ul>
            </nav>

            <form class="logout" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Sair</button>
            </form>
        </div>
    </header>

    <main class="container main-content">
        <div class="list-header">
            <h2 style="margin:0">Meus posts</h2>
            <a class="btn btn-primary add-post" href="{{ route('posts.create') }}">+ Adicionar</a>
        </div>
        @forelse($posts as $post)
            <section class="posts">
                <article class="post-card">
                    <h3 class="post-title"><a href="{{route('posts.view', ['slug'=> $post->slug])}}">{{ $post->title }}</a></h3>
                    <div class="post-meta">
                        Author: <strong>{{ $post->user->name }}</strong>
                        •
                        Category: <strong>{{ optional($post->category)->title ?? 'Todos' }}</strong>
                        <span class="post-date" style="float:right">Data: {{ $post->created_at->format('d/m/Y')  }}</span>
                    </div>
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

        <div style="margin-top:1rem; text-align:center">
            {{ $posts->links() }}
        </div>
    </main>
</body>
</html>