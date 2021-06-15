<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="{{ asset(' ') }}" rel="icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ 'js/historicoProntuario.js' }}" defer></script>
    {{$i = 0}}
    <title>Historico de prontuários</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->

    <!---------------Notificação para o usuário-------------->
    @if(isset($_SESSION['notifi']))
    @if(!empty ($_SESSION['notifi']))
    <div id="notification">
        <div class='msg-notification'>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12 col-sm-12">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="col-lg-8 col-md-8 col-10 col-sm-10">
                    {{$_SESSION['notifi']}} 
                </div>
                <form action="/apagarN" method="get">
                    <div class="col-lg-2 col-md-2 col-2 col-sm-2">
                        <button name="fechar" type="submit" class="btn-close" id="close"><i class="fas fa-times"></i></button>
                    </div>
                </form>
            </div>
        </div>
    <div>
    @endif
    @endif
    <!---------------Fim de notificação-------------->

    <!----------Botão de donwload------------>
    <div id="screen-icon">
        <form method="get" action="/baixarArquivos" class="download-icon">
            <button>
                <i class="fas fa-download"></i>
            </button>
            @if(isset($prontuario))
            <input type="hidden" name="listagem" value="{{implode('|',$prontuario)}}">
            <input type="hidden" name="tela" value="hp">
            @endif
        </form>
    </div>
    <!--------Fim do botão de donwload-------->
    <div class="row">
        <div class="col-lg">
            @if ($errors->any()) <!--Verificando se existe qualquer erro -->
                <div class="msg-error">
                    <ul>
                        @foreach ($errors->all() as $error) <!--Percorre todos os erros-->
                            <li>{{ $error }}</li> <!--Obtem o erro -->
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('msg')) <!-- Verifica se a mensagem de erro foi instanciada -->
                <div class="msg-sucess">
                    {{session('msg')}} <!--Obtem mensagem de erro -->
                </div>
            @endif
            @if (session('msg-error')) <!-- Verifica se a mensagem de erro foi instanciada -->
            <div class="msg-error">
                {{session('msg-error')}} <!--Obtem mensagem de erro -->
            </div>
            @endif
        </div>
    </div>
    
    <div class="container-1" id="historic">
        <h1 class="title-download">HISTÓRICO DE PRONTUÁRIOS </h1>

        <!------------- Busca do paciente ------------->
        <div id="search">
            <div class="box">
                <div class="content-center">
                    <h3>BUSCAR PACIENTE</h3>
                    <form class="search-bar" method="get" action="/hp">
                        <!--- Campo para a inserção do CPF do paciente --->
                        <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required maxlength="14"
                            pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!---------- Fim da Busca do paciente ---------->

        <!---------- Infomações do Paciente buscado ---------->
        @if(isset($prontuario["nome".$i]))
        <div class="row">
            <!------ Nome do Paciente ------>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="box-blue">
                    {{$prontuario["nome".$i]}}
                </div>
            </div>
            <!------ CPF do Paciente ------>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="box-blue">
                    CPF:  {{$prontuario["cpf".$i]}}
                </div>
            </div>
        </div>
        <!------ Fim das infomações do Paciente buscado ------>
        @for($i = 0;$i <= (count($prontuario)/7);$i++)
        @if(isset($prontuario["nome".$i]))
        <br> 
        <!---------- Histórico de prontuários ---------->
        <div id="record">

            <!------------- Prontuário ------------->
            <div class="box-historic">
                <div class="row">
                    <!------ Data de internação ------>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                        <label>Data de Internação:</label> <br>
                        <div class="box-gray">
                            {{$prontuario["internacao".$i]}}
                        </div>
                    </div>
                    <!------ Data de saída ------>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                        <label>Data de Saída:</label> <br>
                        <div class="box-gray">
                            {{$prontuario["saida".$i]}}
                        </div>
                    </div>
                    <!------ Motivo da saída ------>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <label>Motivo:</label> <br>
                        <div class="box-gray">
                            {{$prontuario["estado".$i]}}
                        </div>
                    </div>
                    <!------ Botão para acessar prontuário ------>
                    <form action="/prontuario" method="get">
                    <input type="hidden" name='cpf' value='{{$prontuario["cpf".$i]}}'>
                    <input type="hidden" name='numero' value='{{$prontuario["id".$i]}}'>
                    <div class="col-12 col-sm-6 col-md-12 col-lg-3 input-full-width">
                        <br>
                        <button type="submit" class="btn-blue">Prontuário</button>
                    </div>
                    </form>
                </div>
            </div>
            <!------------- fim do prontuário ------------->
        @endif
        @endfor
        @endif
        <!---------- Fim de histórico de prontuários ---------->
    </div>
</body>

</html>
