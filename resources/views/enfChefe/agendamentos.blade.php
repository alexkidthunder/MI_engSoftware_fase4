

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    {{$i = 0}}
    <title>Listagem de agendamentos</title>
    
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
    <div class="container">
        <div id="screen-icon"> <!-- Icone de Download Em Telas -->
            <form method="get" action="/baixarArquivos" class="download-icon">
                <button>
                    <i class="fas fa-download"></i>
                </button>
                @if(isset($infos["hora0"]))
                <input type="hidden" name="listagem" value="{{implode('|',$infos)}}">
                <input type="hidden" name="tela" value="la">
                @endif
            </form>
        </div>
    </div>

        <div class="container-1">
    
            <h1 class="title-download">LISTAGEM DE AGENDAMENTOS E MEDICAMENTOS </h1>

            <!---------------------Agendamento--------------------->
            @for($i = 0;$i < count($infos)/8;$i++)
            @if(isset($infos))
            <div class="box-scheduling" id="scheduling">
                    <div class="row">
                        <!---------------------Hora--------------------->
                        <div class="col-6 col-sm-12 col-md-6 col-lg-2  text-center">
                            <div class="box-gray">
                                {{$infos["hora".$i]}}
                             </div>
                        </div>
                        <!---------------------Data--------------------->
                        <div class="col-6 col-sm-12 col-md-6 col-lg-2  text-center">
                            <div class="box-gray">
                                {{$infos["data".$i]}}
                            </div>
                        </div>
                        <!---------------------Nome do Medicamento--------------------->
                        <div class="col-12 col-sm-12 col-md-6 col-lg-5 text-center">
                            <div class="box-white scrolls">
                                {{$infos["medicamento".$i]}}
                             </div>
                        </div>
                        <!---------------------Posologia--------------------->
                        <div class="col-12 col-sm-12 col-md-6 col-lg-3 text-center">
                            <div class="box-white">
                                {{$infos["posologia".$i]}} ml
                            </div>
                        </div>
                    </div>
                    <!---------------------Nome da Paciente--------------------->
                    <form action="/prontuario" method="get">
                        <div class="row">
                            <input type="hidden" name='cpf' value="{{$infos['identificaP'.$i]}}">
                            <input type="hidden" name='numero' value='{{$infos["id".$i]}}'>
                            <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                                <button type="submit" class="btn-Patient scrolls text-center">{{$infos["paciente".$i]}}</button>
                            </div>
                            <!---------------------Leito da Paciente--------------------->
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 text-center">
                                <div class="box-blue scrolls">
                                    Leito: {{$infos["leito".$i]}}
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
            @endif
            @endfor
            <!---------------------Fim de agendamento--------------------->
            
  </body>
  </html>
