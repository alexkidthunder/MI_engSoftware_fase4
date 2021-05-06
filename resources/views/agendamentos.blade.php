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
    
    <title>Meus agendamentos</title>
    
  </head>
  <!--ENFERMEIRO E ESTAGIARIO -->
  <body>
        <!----------Hearder------------>
        @include('layouts.navbar')
        <!----------End Hearder-------->
    <section>
    
        <div class="container-1" id="scheduling">
            <h1>VERIFICAÇÃO DE AGENDAMENTOS</h1>

            <!----------Agendamentos------------>
            
            <div class="box-scheduling">
                <!--=====Informação do agendamento======-->
                    <div class="row">
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                xx:xx
                            </div>
                        </div>
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                xx/xx/xx
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-white">
                                Nome do Medicamento Aqui
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="box-white">
                                Posologia
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <button class="btn-Patient text-left">Nome do paciente aqui</button>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-blue">
                                Leito: Código
                            </div>
                        </div>
                    </div>
                    <!--=====Botões do agendamento======-->
                    <div class="row">
                        <div class="col-lg-2">
                            <p>Prepador da aplicação:</p>
                        </div>
                        <!--=====isso aqui fica hidden======-->
                        <div class="col-lg-7"> 
                            <div class="box-gray"> 
                                Nome do Preparador Aqui
                            </div>
                        </div>
                        <!--===============================-->
                        
                        <div class="col-lg-3">
                            <div>
                                <button type="submit" class="btn-white"> Adicionar preparador</button>
                            </div>
                        </div>

                        <!--isso aqui fica hidden até que seja add preparador--->
                        <div class="col-lg-3">
                            <div>
                                <button type="submit" class="btn-white"> Finalizar aplicação</button>
                            </div>
                        </div>
                        <!--===============================-->
                    </div>             
            </div>         
        </div>
    </section>
  </body>