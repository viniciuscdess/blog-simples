<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Register</title>
     <style>
          /* Garante que o body ocupe a altura total da janela */
          html, body { height: 100%; margin: 0; }

          /* Wrapper que centraliza conteúdo vertical e horizontalmente */
          .center-wrapper {
               min-height: 100vh;
               display: flex;
               align-items: center;
               justify-content: center;
               padding: 1rem;
               box-sizing: border-box;
               background: #f8fafc; /* cor de fundo suave, opcional */
          }

          /* Estilo básico do formulário */
          .login-form {
               width: 100%;
               max-width: 380px;
               background: #ffffff;
               padding: 24px;
               border-radius: 8px;
               box-shadow: 0 4px 12px rgba(0,0,0,0.06);
               box-sizing: border-box;
          }

          .login-form input[type="text"],
          .login-form input[type="email"],
          .login-form input[type="password"] {
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
          <form class="login-form" action="{{ route('register.store') }}" method="POST">
               @csrf
               <div>
                    <label for="name">Nome</label>
                    <input type="text" name="name" placeholder="Digite seu nome completo" id="name" value="{{old('name')}}"/>
                    @error('name') <div style="color:red">{{ $message }}</div> @enderror

                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Digite seu email" id="email" value="{{old('email')}}"/>
                    @error('email') <div style="color:red">{{ $message }}</div> @enderror

                    <label for="password">Senha</label>
                    <input type="password" name="password" placeholder="Digite sua senha" id="password"/>
                    @error('password') <div style="color:red">{{ $message }}</div> @enderror

                    <label for="password_confirmation">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme sua senha"/>
                    @error('password') <div style="color:red">{{ $message }}</div> @enderror
                    
                    <button type="submit">Enviar</button>
               </div>
          </form>
     </div>
</body>
</html>