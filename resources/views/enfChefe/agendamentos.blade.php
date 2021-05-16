

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
    
    <title>Listagem de agendamentos</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @if(isset($_SESSION['enfermeiro']))
    @include('layouts.navbar')
    @endif
    @if(isset($_SESSION['enfermeiroChefe']))
    @include('layouts.navbar-enfChefe')
    @endif
    @if(isset($_SESSION['estagiario']))
    @include('layouts.navbar')
    @endif
    <!----------End Hearder-------->
        <div id="screen-icon"> <!-- Icone de Download Em Telas -->
            <form class="download-icon">
                <button>
                    <i class="fas fa-download"></i>
                </button>
            </form>
        </div>
   
        <div class="container-1">
    
            <h1>LISTAGEM DE AGENDAMENTOS E MEDICAMENTOS </h1>

            <!---------------------Agendamento--------------------->
            <div class="box-scheduling">
                    <div class="row">
                        <!---------------------Hora--------------------->
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                22:30h
                             </div>
                        </div>
                        <!---------------------Data--------------------->
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                20/04/2021
                            </div>
                        </div>
                        <!---------------------Nome do Medicamento--------------------->
                        <div class="col-lg-6">
                            <div class="box-white">
                            Dipirona
                             </div>
                        </div>
                        <!---------------------Posologia--------------------->
                        <div class="col-lg-2">
                            <div class="box-white">
                                0.35 ml
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <!---------------------Nome da Paciente--------------------->
                        <div class="col-lg-9">
                            <button class="btn-Patient text-left">Samara Anjos de Oliveira</button>
                        </div>
                        <!---------------------Leito da Paciente--------------------->
                        <div class="col-lg-3">
                            <div class="box-blue">
                                Leito: AB04
                            </div>
                        </div>
                    </div>
            </div>
            <!---------------------Fim de agendamento--------------------->
        </div>
  </body>
  </html>