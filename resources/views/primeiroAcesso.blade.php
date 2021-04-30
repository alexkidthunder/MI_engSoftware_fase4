<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeiro Acesso</title>

    <link href="{{ ('css/login-style.css') }}" rel="stylesheet"> 

</head>
<body class="body-login">

    <form id="login" class = "form" action="">
    <div class="box-login" id="primeiro-acesso">
            <h2>Bem Vindo ao "Nome do App"</h2>
            <h4>Este é o seu primeiro acesso "Primeiro nome do usuário"!<br>Defina sua senha abaixo:</h4>
            <div>
                <label>Senha</label>
                <input type="password" name= "senha" placeholder="Digite sua senha" required>
            </div>
            <div class="enter">
                <button type= "submit">Enviar</button>
            </div>
        </div>
    </form>
   
</body>
</html>