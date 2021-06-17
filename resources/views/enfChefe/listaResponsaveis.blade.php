

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    {{$i = 0}}
    <title>Responsáveis por aplicações</title>
    
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
            @if(isset($infos["responsavel0"]))
            <input type="hidden" name="listagem" value="{{implode('|',$infos)}}">
            <input type="hidden" name="tela" value="lr">
            @endif
        </form>
        </div>
        
        <div class="container-1">
    
            <h1 class="title-download">RESPONSÁVEIS PELA APLICAÇÃO DE MEDICAMENTOS</h1>

            <!---------------------Agendamento Realizado--------------------->
            @for($i = 0; $i <= count($infos); $i++)
            @if(isset($infos["medicamento".$i]))
            <div class="box-scheduling" id="scheduling">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-2 text-center">
                            <div class="box-gray">
                                {{$infos["hora".$i]}}
                             </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-2 text-center">
                            <div class="box-gray">
                                {{$infos["data".$i]}}
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="box-white scrolls">
                                {{$infos["medicamento".$i]}}
                             </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                            <div class="box-white">
                                {{$infos["posologia".$i]}} ml
                            </div>
                        </div>
                    </div>

                    <form action="/prontuario" method="get">
                    <div class="row">
                        <div class="col-md-4 col-lg-2 col-xl-2">
                            <p>Paciente</p>
                        </div>
                            <input type="hidden" name='cpf' value='{{$identificaP}}'>
                            <input type="hidden" name='numero' value='{{$infos["id".$i]}}'>
                            <div class="col-md-9 col-lg-7 col-xl-7">
                                <button type="submit" class="btn-Patient">{{$infos["paciente".$i]}}</button>
                            </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                            <div class="box-blue">
                                Leito: {{$infos["leito".$i]}}
                            </div>
                        </div>
                    </div>
                </form>
                   
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                            <p>Responsável</p>
                        </div>
                        <div class="col-md-10 col-lg-7 col-xl-7">
                            <div class="box-gray">
                                {{$infos["responsavel".$i]}}
                            </div>
                        </div>
                    </div>
            </div>
            @endif
            @endfor
            <!---------------------Fim de agendamento--------------------->
           
        </div>
  </body>
  </html>