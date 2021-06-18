<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova senha</title>

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
    <form id="first-access" class="form" action="{{ route('checarCPF') }}" method="POST">
        @csrf 
        <div class="box-login">

            <h2>Nova senha</h2>
            <h4>Defina seu CPF abaixo:</h4>
            <div>
                <!------- Inserção da cpf ------>
                <label>CPF</label>
                <input id="cpf" name="cpf" type="text" onkeyup="mascara('###.###.###-##',this,event,true)" 
                            required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
            </div>
            <div class="enter">
                <button type="submit">ENVIAR</button>
            </div>
        </div>
    </form>
</body>

</html>
