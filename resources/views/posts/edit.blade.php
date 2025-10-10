
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
        <section class="posts">
            <article class="post-card">
                <h2 class="post-title">Editar Postagem</h2>

                <form action="{{route('posts.store')}}" method="POST" style="margin-top:1rem; display:block;">
                    @csrf

                    <label for="title" style="display:block; font-weight:600; margin-bottom:0.25rem;">Título</label>
                    <input id="title" name="title" type="text" style="width:100%; padding:0.6rem; border:1px solid rgba(11,18,32,0.08); border-radius:8px; margin-bottom:0.75rem;" value="{{$post->title}}">

                    <label for="title" style="display:block; font-weight:600; margin-bottom:0.25rem;">Texto</label>
                    <textarea name="text" id="text" cols="30" rows="10" style="width:100%; padding:0.6rem; border:1px solid rgba(11,18,32,0.08); border-radius:8px; margin-bottom:0.75rem;">{{$post->text}}</textarea>

                    <label for="category" style="display:block; font-weight:600; margin-bottom:0.25rem;">Categoria</label>
                    <select name="category_id" id="category" style="width:100%; padding:0.6rem; border:1px solid rgba(11,18,32,0.08); border-radius:8px; margin-bottom:0.75rem;">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ ($category->id == $post->category_id) ? 'selected' : ""}}> 
                                   {{$category->title}} 
                              </option>
                        @endforeach
                    </select>

                    <div style="display:flex; gap:0.5rem;">
                        <button type="submit" style="background:#0b1220; color:#fff; border:none; padding:0.6rem 0.9rem; border-radius:8px; cursor:pointer;">Editar</button>

                        <a href="{{ route('posts.index') }}" style="display:inline-block; padding:0.6rem 0.9rem; border-radius:8px; border:1px solid rgba(11,18,32,0.06); color:#334155; text-decoration:none;">Cancelar</a>
                    </div>
                </form>

            </article>
        </section>
    </main>
</body>
</html>