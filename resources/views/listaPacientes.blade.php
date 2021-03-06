<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ 'js/listaPaciente.js' }}" defer></script>

    {{$i = 0}}
    <title>Lista de paciente</title>

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
            @if(isset($p[0]))
            <input type="hidden" name="listagem" value="{{implode('|',$p)}}">
            <input type="hidden" name="tela" value="lp">
            <input type="hidden" name='numero' value='{{$p[0]}}'>
            @endif
        </form>
    </div>
    <!--------Fim do botão de donwload-------->

    <div class="container-1" id="patientList">
        <!---------------------Mensagens de erro--------------------->
        <div class="container">
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
        </div>        
        <!---------------------Fim da mensagem de erro--------------------->
        
        <h1 class="title-download">PACIENTES E PRONTUÁRIOS</h1>

        <!----------Seleção para o tipo de paciente que deseja exibir------------>
        <div class="content-center">
            <form>
                <select id="novaAtribuicao" name="novaAtribuicao" onchange="this.form.submit()">
                    <option value="" disabled selected>--Escolha uma opção--</option>
                    <option value="internado" name="internado">Pacientes internados</option>
                    <option value="alta" name="alta">Pacientes de alta</option>
                    <option value="obito" name="obito">Pacientes em óbito</option>
                </select>
            </form>
        </div>

        <!--------------------- Paciente --------------------->
        @if(isset($p))
            @for($i = 0;$i <= count($p); $i++)
            @if(isset($p[$i]))
            <div class="box-white">
                <div class="row">
                    <!---------- Nome do paciente ------------>
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="box-blue">
                            {{$p[$i]}}
                        </div>
                    </div>
                    <!----- Link para o prontuário do paciente ----->

                    <form class="col-12 col-sm-12 col-md-2 col-lg-2" action="/prontuario" method="get">
                        <input type="hidden" name='cpf' value='{{$identicador[$i]}}'>
                        @if(isset($p["id".$i]))
                        <input type="hidden" name='numero' value='{{$p["id".$i]}}'>
                        @endif
                        <button type="submit" class="btn-blue">Prontuário</button>
                    </form> 
                </div>
            </div>
            @endif
            @endfor
        @endif
        <!--------------------- Fim do paciente --------------------->
    </div>
</body>

</html>