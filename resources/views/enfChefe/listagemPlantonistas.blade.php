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
    {{$i = 0}}
    <title>Listagem Plantonista</title>

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

    <div id="screen-icon"> <!-- Icone de Download Em Telas -->
        <form method="get" action="/baixarArquivos" class="download-icon">
            <button>
                <i class="fas fa-download"></i>
            </button>
            @if(isset($plantonista["nome".$i]))
            <input type="hidden" name="listagem" value="{{implode('|',$plantonista)}}">
            <input type="hidden" name="tela" value="lpt">
            @endif
        </form>
    </div>

    <section>
        <div class="container-1" id="on-duty">
            <h1 class="title-download">LISTAGEM DE PLANTONISTA</h1>
            <div class="box-on-duty">
                <!--------- Cabeçalho --------->
                <div class="title">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-8 col-lg-8">
                            NOME
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                            CARGO
                        </div>
                    </div>
                </div>
                @for($i = 0; $i <= count($plantonista); $i++)
                    @if(isset($plantonista["nome".$i]))
                    <!--------- Plantonista --------->
                    <!---APENAS ISSO QUE SE REPETE BACK, O CABEÇARIO N -->
                    <div class="box-blue">
                        <div class="row">
                            <div class="col-6 col-sm-6 col-md-8 col-lg-8 text-left">
                                {{$plantonista["nome".$i]}}
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-4 text-left">
                                {{$plantonista["cargo".$i]}}
                            </div>
                        </div>
                    </div>
                    @endif
                <!------- Fim de plantonista ------->
                @endfor
            </div>
        </div>
    </section>
</body>

</html>
