<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <title>Controle de medicamentos</title>
     
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">-->
    <link href="{{ ('css/login-style.css') }}" rel="stylesheet"> 

</head>
<body class="body-login">

    <div id="access-box">
        <a href="{{ route('primeiroAcesso') }}">Primeiro acesso? Clique aqui para definir a senha</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg">
                    @if ($errors->any())
                        <div class="msg-error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('msg'))
                    <div class="msg-error">
                        {{session('msg')}}
                    </div>
                    @endif
            </div>
        </div>
    </div>

   
    <form id="login" action="/index/menu" method= "post">
    @csrf
    <div class="box-login">
            <h2>Login</h2>
            <div>
                <label>CPF</label>
                <input type="text" name= "cpf" placeholder="Digite seu CPF" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
            </div>
            <div>
                <label>Senha</label>
                <input type="password" name= "senha" placeholder="Digite sua senha" required>
            </div>
            <div class="enter">
                <button type= "submit">ENTRAR</button>
            </div>
            <a href="{{ route('esqueciSenha')}}"><label class="text">Esqueceu a senha?</label></a>
        </div>
    </form>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
