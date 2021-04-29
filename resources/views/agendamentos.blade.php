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
    
    <title>Meus agendamentos</title>
    
  </head>
  <!--ENFERMEIRO E ESTAGIARIO -->
  <body>
        <!----------Hearder------------>
        @include('layouts.navbar')
        <!----------End Hearder-------->
    <section>
    
        <div class="container-1">
            <h1>VERIFICAÇÃO DE AGENDAMENTOS</h1>

            <!----------Agendamentos------------>
            
            <div class="box-agendamento">
                    <div class="row">
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                <a>xx:xx</a>
                            </div>
                        </div>
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                <a>xx/xx/xx</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-white">
                                <a>Nome do Medicamento Aqui</a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="box-white">
                                <a>Posologia</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <button class="btn-Patient text-left">Nome do paciente aqui</button>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-blue">
                                <a>Leito: Código</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <p>Prepador da aplicação:</p>
                        </div>
                        <div class="col-lg-7"> <!--isso aqui fica hidden--->
                            <div class="box-gray"> 
                                <a>Nome do Preparador Aqui</a> 
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <input type="button" id="add_prep" value="Adicionar Preparador">
                            </div>
                        </div>
                    </div>
                
            </div>
            <!--Outro Agendamento-->
            <div class="box-agendamento">
                    <div class="row">
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                <a>xx:xx</a>
                            </div>
                        </div>
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                <a>xx/xx/xx</a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-white">
                                <a>Nome do Medicamento Aqui</a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="box-white">
                                <a>Posologia</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="box-blue">
                                <a>Nome do Paciente Aqui</a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-blue">
                                <a>Leito: Código</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9"> <!--isso aqui fica hidden--->
                            <div class="box-blue"> 
                                <a>Nome do Preparador Aqui</a> 
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <input type="button" id="add_prep" value="Adicionar Preparador">
                            </div>
                        </div>
                    </div>
            </div>         
        </div>
    </section>
  </body>