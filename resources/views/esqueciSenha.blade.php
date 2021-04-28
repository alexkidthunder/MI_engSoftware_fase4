<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>

    <link href="{{ ('css/login-style.css') }}" rel="stylesheet"> 

</head>
<body>

   
    <form class = "form" action="">
        <div class="card">
            <div class="card-top">
                <h2 class = titulo>Esqueci a senha</h2>
            </div>
                
            <div class="card-group">
                <label>CPF</label>
                <input type="text" name= "cpf" placeholder="Digite seu CPF" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
            </div>
            
            <div class="card-group">
                <label>Email</label>
                <input type="password" name= "senha" placeholder="Digite seu Email">
            </div>

            <div class="card-group btn">
                <button type= "submit">Enviar</button>
            </div>
            <div class="texto-interativo">
                <label><a href="/">Tela de Login</a></label>
            </div>
        </div>
    </form>
   
</body>
</html>