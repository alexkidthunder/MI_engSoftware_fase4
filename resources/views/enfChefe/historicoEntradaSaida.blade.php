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
    
    <title>Historico de Entrada e Saída</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar-enfChefe')
    <!----------End Hearder-------->
    
    <!--ENFERMEIRO E ESTAGIARIO -->
        <div class="container-1">
    
            <h1>Histórico de Entrada e Saida</h1>
            <h2> Samara Anjos de Oliveira </h2>
            <h2></h2>

            <div class="box-agendamento">
                <div class="row">
                        <div class="col-lg-6 text-center">
                            <div class="box-gray">
                                Entrada: 20/04/2021, ás 09:11h
                            </div>
                        </div>
                        
                        <div class="col-lg-6 text-center">
                            <div class="box-gray">
                                Saida: 22/04/2021, ás 22:34h
                             </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-9">
                            <button class="btn-Patient text-left">CID: 044, CID: 021, CID: 255</button>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-blue">
                                Leito: AB04
                            </div>
                        </div>
                    </div>
            </div>
            <h2></h2>
            <div class="box-agendamento">
                    <div class="row">
                        <div class="col-lg-6 text-center">
                            <div class="box-gray">
                                Entrada: 30/04/2021, ás 04:21h
                            </div>
                        </div>
                        
                        <div class="col-lg-6 text-center">
                            <div class="box-gray">
                                Saida: 01/05/2021, ás 2:54h
                             </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9">
                            <button class="btn-Patient text-left">CID: 044, CID: 021, CID: 255</button>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-blue">
                                Leito: AB12
                            </div>
                        </div>
                    </div>
            </div>
            <h2></h2>
            <div class="box-agendamento">
                    <div class="row">
                        <div class="col-lg-6 text-center">
                            <div class="box-gray">
                                Entrada: 01/05/2021, ás 09:11h
                            </div>
                        </div>
                        
                        <div class="col-lg-6 text-center">
                            <div class="box-gray">
                                Saida: 08/05/2021, ás 22:34h
                             </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-9">
                            <button class="btn-Patient text-left">CID: 044, CID: 021, CID: 255</button>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-blue">
                                Leito: AB03
                            </div>
                        </div>
                    </div>
            </div>
            <!---------------------Fim do Histórico--------------------->
           
        </div>
  </body>
