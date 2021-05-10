<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeiro Acesso</title>

    <link href="{{ ('css/login-style.css') }}" rel="stylesheet"> 
    
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
</head>
<body class="body-login">
    <div id="access-box">
        <a href="{{ route('index') }}">Login</a>
    </div>

    <form id="first-access" class = "form" action="">
    <div class="box-login">
            <h2>Primeiro acesso</h2>
            <h4>Defina sua senha abaixo:</h4>
            <div>
                <label>Senha</label>
                <input type="password" name= "senha" placeholder="Digite sua senha" required>
            </div>
            <div>
                <label>Confirmação</label>
                <input type="password" name= "senha" placeholder="Digite a mesma senha" required>
            </div>
            <div class="enter">
                <button type= "submit">Enviar</button>
            </div>
        </div>
    </form>
   
</body>
</html>