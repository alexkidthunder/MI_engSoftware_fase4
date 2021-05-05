

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Favicons -->
    <link href="{{ asset(' ') }}" rel="icon">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
    <title>Agendamentos realizados</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    
    <!--ENFERMEIRO E ESTAGIARIO -->
        <div class="container-1">
    
            <h1>AGENDAMENTOS E MEDICAMENTOS REALIZADOS</h1>

            <!---------------------Agendamento Realizado--------------------->
            <div class="box-scheduling">
                    <div class="row">
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                22:30h
                             </div>
                        </div>
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                20/04/2021
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-white">
                            Dipirona
                             </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="box-white">
                                0.35 ml
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9">
                            <button class="btn-Patient text-left">Samara Anjos de Oliveira</button>
                        </div>
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
