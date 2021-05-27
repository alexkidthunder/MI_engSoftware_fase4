<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeiro Acesso</title>

    <link href="{{ 'css/login-style.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
</head>

<body class="body-login">
    <!----- Caixa para tela de primeiro acesso ----->
    <div id="access">
        <div class="access-box">
            <a href="{{ route('index') }}">Login</a>
        </div>
    </div>
    <!---------------- fim da Caixa --------------->

    
    @if(Session::has('error'))
    <div class="msg-error" role="alert">
            {{Session::get('error')}}
    </div>
    @endif  

    @if(Session::has('success'))
    <div class="msg-sucess">
            {{Session::get('success')}}
    </div>
    @endif      

    <!--Página de meu primeiro acesso -->
    <form id="first-access"  class = "form" action="{{ route('primeiroAcesso') }}" method="POST">
        @csrf
        <div class="box-login">
            <input type="hidden" name="cpf" value="{{Session::get('cpf')}}">

            <h2>Primeiro acesso</h2>
            <h4>Defina sua senha abaixo:</h4>
            <div>
                <!-- Inserção da senha -->

                <label>Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha" required>
            </div>
            <div>
                <!-- Confirmação da senha digitada -->
                <label>Confirmação</label>
                <input type="password" name= "confirmacao" placeholder="Digite a mesma senha" required>

            </div>
            <div class="enter">
                <button type="submit">Enviar</button>
            </div>
        </div>
    </form>
</body>

</html>
