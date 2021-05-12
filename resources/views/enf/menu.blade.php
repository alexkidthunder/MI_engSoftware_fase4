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
    
    <title>Menu</title>
  </head>
  <body class="body-menu" hrfe = '/sessaoEnf'>
    <!----------Hearder------------>
    @include('layouts.navbar-menu')
    <!----------End Hearder-------->

        <div class="container-2">
            <div class="row">
                
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-injured"></i>
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroPaciente') }}">Cadastrar paciente</a></h4>
                    </div>
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-clipboard-list"></i>
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="#">Cadastrar prontuário</a></h4>
                    </div>
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-injured"></i>
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('pacientes') }}">Pacientes e prontuários</a></h4>
                    </div>
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('agendamentosRealizados') }}">Agendamentos realizados</a></h4>
                    </div>
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <div><i class="fas fa-notes-medical"></i></div>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('agendamentos') }}">Agendamentos</a></h4>
                    </div>
                </div> 

                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-nurse"></i>
                            <i class="fas fa-notes-medical"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('meusAgendamentos') }}">Agendamentos e <br>medicamentos que estou alocado</a></h4>
                    </div>
                </div> 
               
            </div>  
        </div>
  </body>
