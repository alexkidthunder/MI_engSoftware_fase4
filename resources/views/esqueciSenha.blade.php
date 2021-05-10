<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>

    <link href="{{ ('css/login-style.css') }}" rel="stylesheet"> 

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
</head>
<body class="body-login">
    <div id="access-box">
        <a href="{{ route('index') }}">Login</a>
    </div>
    
    <form id="login" class = "form" action="">
    <div class="box-login">
            <h2>Esqueci a Senha</h2>
            <div>
                <label>Email</label>
                <input type="email" name= "email" placeholder="Digite seu Email" required>
            </div>
            <div class="enter">
                <button type= "submit">Enviar</button>
            </div>
        </div>
    </form>
   
</body>
</html>