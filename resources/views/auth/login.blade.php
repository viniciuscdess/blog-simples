<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Login</title>
     <style>
          html, body { height: 100%; margin: 0; }

          .center-wrapper {
               min-height: 100vh;
               display: flex;
               align-items: center;
               justify-content: center;
               padding: 1rem;
               box-sizing: border-box;
               background: #f8fafc;
          }

          .login-form {
               width: 100%;
               max-width: 380px;
               background: #ffffff;
               padding: 24px;
               border-radius: 8px;
               box-shadow: 0 4px 12px rgba(0,0,0,0.06);
               box-sizing: border-box;
          }

          .login-form input {
               width: 100%;
               padding: 10px 12px;
               margin: 8px 0 12px 0;
               border: 1px solid #d1d5db;
               border-radius: 6px;
               box-sizing: border-box;
          }
     </style>
</head>
<body>
     <div class="center-wrapper">
          <form class="login-form" action="{{route('login.store')}}" method="POST">
               @csrf
               <div>
                    <label for="email">Login</label>
                    <input type="text" name="email" placeholder="Digite seu email" id="email" />

                    <label for="password">Senha</label>
                    <input type="password" name="password" placeholder="Digite sua senha" id="password" />

                    <a href="{{route('register')}}">Nao tenho conta?</a>
                    <button type="submit">Enviar</button>
               </div>
          </form>
     </div>
</body>
</html>