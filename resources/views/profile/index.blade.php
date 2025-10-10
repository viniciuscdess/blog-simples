
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
                    <li><a href="{{ route('home.index') }}">Dashboard</a></li>
                    <li><a href="#">Perfil</a></li>
                    <li><a href="#">Meus posts</a></li>
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
                <h2 class="post-title">Meu Perfil</h2>
                <div class="post-meta">Atualize seus dados abaixo</div>

                <!-- Formulário front-end apenas -->
                <form action="#" method="POST" style="margin-top:1rem; display:block;">
                    @csrf

                    <label for="name" style="display:block; font-weight:600; margin-bottom:0.25rem;">Nome</label>
                    <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name ?? '') }}" style="width:100%; padding:0.6rem; border:1px solid rgba(11,18,32,0.08); border-radius:8px; margin-bottom:0.75rem;">

                    <label for="email" style="display:block; font-weight:600; margin-bottom:0.25rem;">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email ?? '') }}" style="width:100%; padding:0.6rem; border:1px solid rgba(11,18,32,0.08); border-radius:8px; margin-bottom:0.75rem;">

                    <label for="password" style="display:block; font-weight:600; margin-bottom:0.25rem;">Senha</label>
                    <input id="password" name="password" type="password" placeholder="Deixe em branco para manter a senha atual" style="width:100%; padding:0.6rem; border:1px solid rgba(11,18,32,0.08); border-radius:8px; margin-bottom:0.75rem;">

                    <label for="password_confirmation" style="display:block; font-weight:600; margin-bottom:0.25rem;">Confirmar senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" style="width:100%; padding:0.6rem; border:1px solid rgba(11,18,32,0.08); border-radius:8px; margin-bottom:1rem;">

                    <div style="display:flex; gap:0.5rem;">
                        <button type="submit" style="background:#0b1220; color:#fff; border:none; padding:0.6rem 0.9rem; border-radius:8px; cursor:pointer;">Salvar</button>
                        <a href="{{ route('home.index') }}" style="display:inline-block; padding:0.6rem 0.9rem; border-radius:8px; border:1px solid rgba(11,18,32,0.06); color:#334155; text-decoration:none;">Cancelar</a>
                    </div>
                </form>

            </article>
        </section>
    </main>
</body>
</html>