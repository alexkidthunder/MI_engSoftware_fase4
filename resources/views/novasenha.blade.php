<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova senha-CPF</title>

    <link href="{{ 'css/login-style.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
</head>

<body class="body-login">
    <!--------------- Imagem de onda--------------->
    <div id="container-wave">
        <div class="img-login">
            <img src="{{ asset('img/wave.png') }}" />
        </div>
    </div>
    <!--------------- fim da Imagem -------------->
    <!----------- Imagem de enfermeiros ----------->
    <div id="container-img">
        <div class="img-login">
            <img src="{{ asset('img/doctors.png') }}" />
        </div>
    </div>
    <!--------------- fim da Imagem -------------->
    <!----- Caixa para tela de primeiro acesso ----->
    <div id="access">
        <div class="access-box">
            <a href="{{ route('index') }}">Login</a>
        </div>
    </div>
    <!---------------- fim da Caixa --------------->

    <!-----------Mensagem de erro----------->
    @if (Session::has('error'))
        <div class="msg-error" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <!-----------Mensagem de sucesso----------->
    @if (Session::has('success'))
        <div class="msg-sucess">
            {{ Session::get('success') }}
        </div>
    @endif

    <!--Página de meu primeiro acesso -->
    <form id="first-access" class="form" action="{{ route('definirSenha') }}" method="POST">
        @csrf 
        <div class="box-login">
            <input type="hidden" name="cpf" value="{{ Session::get('cpf') }}">

            <h2>Nova senha</h2>
            <h4>Defina sua senha abaixo:</h4>
            <div>
                <!------- Inserção da senha ------>
                <label>Nova senha</label>
                <input type="password" name="senha" placeholder="Digite a sua nova senha" required>
            </div>
            <div>
                <!-------Confirmação da senha digitada ------->
                <label>Confirmação</label>
                <input type="password" name="confirmacao" placeholder="Digite a senha novamente" required>

            </div>
            <div class="enter">
                <button type="submit">ENVIAR</button>
            </div>
        </div>
    </form>
</body>

</html>
