

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
    
    <title>Responsáveis por aplicações</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
        <div id="screen-icon"> <!-- Icone de Download Em Telas -->
            <form class="download-icon">
                <button>
                    <i class="fas fa-download"></i>
                </button>
            </form>
        </div>
        
        <div class="container-1">
    
            <h1 class="title-download">RESPONSÁVEIS PELA APLICAÇÃO DE MEDICAMENTOS</h1>

            <!---------------------Agendamento Realizado--------------------->
            <div class="box-scheduling" id="scheduling">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-2 text-center">
                            <div class="box-gray">
                                22:30h
                             </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-2 text-center">
                            <div class="box-gray">
                                20/04/2021
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="box-white">
                            Dipirona
                             </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                            <div class="box-white">
                                0.35 ml
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-lg-2 col-xl-2">
                            <p>Paciente</p>
                        </div>
                        <div class="col-md-9 col-lg-7 col-xl-7">
                            <a href="{{ route('prontuario') }}" target="_parent"><button class="btn-Patient">Samara Anjos de Oliveira</button></a>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xl-3">
                            <div class="box-blue">
                                Leito: AB04
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-xl-2">
                            <p>Responsável</p>
                        </div>
                        <div class="col-md-10 col-lg-7 col-xl-7">
                            <div class="box-gray">
                                José Oliveira Silva
                            </div>
                        </div>
                    </div>
            </div>
            <!---------------------Fim de agendamento--------------------->
           
        </div>
  </body>
  </html>