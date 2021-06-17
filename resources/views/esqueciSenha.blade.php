<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>

    <link href="{{ 'css/login-style.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

</head>

<body class="body-login">
    <!----------------Imagem de onda------------->
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


    <!-------Mensagem de erro------->
        @if(Session::has('error'))
        <div class="msg-error" role="alert">
                {{Session::get('error')}}
        </div>
        @endif  
        <!-------Mensagem de sucesso------->
        @if(Session::has('success'))
        <div class="msg-sucess">
                {{Session::get('success')}}
        </div>
        @endif




    <!----------- Recuperação da senha do usuário ----------->
    <form id="password-login" class="form" action="{{ route('esqueciSenha') }}" method="POST">
        @csrf
        <div class="box-login">
            <h2>Esqueci a senha</h2>
            <h4>Informe no campo abaixo o endereço de e-mail de cadastro que você possui no site</h4>
            <div>
                <!------ Campo para a inserção do e-mail ------>
                <label>Email</label>
                <input type="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <!------- Botão para enviar o link de recuperação ------->
            <div class="enter">
                <button type="submit">ENVIAR</button>
            </div>
        </div>
    </form>
</body>

</html>
