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
                
                <div class="col-sm-6 col-md-4 col-lg-3"> <!--Botão para cadastro de paciente-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-injured"></i>
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroPaciente') }}">Cadastrar paciente</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                <div class="col-sm-6 col-md-4 col-lg-3"> <!--Botão para cadastrar prontuário-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-clipboard-list"></i>
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroProntuario') }}">Cadastrar prontuário</a></h4>
                    </div>
                </div>  <!--Fim do Botão-->
                <div class="col-sm-6 col-md-4 col-lg-3"> <!--Botão para ver pacientes e prontuários-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-injured"></i>
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('pacientes') }}">Pacientes e prontuários</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                <div class="col-sm-6 col-md-4 col-lg-3"> <!--Botão para visualizar agendamentos realizados-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('agendamentosRealizados') }}">Agendamentos realizados</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                <div class="col-sm-6 col-md-4 col-lg-3"> <!--Botão para visualizar agendamentos-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <div><i class="fas fa-notes-medical"></i></div>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('agendamentos') }}">Agendamentos</a></h4>
                    </div>
                </div> <!--Fim do Botão-->

                <div class="col-sm-6 col-md-4 col-lg-3"> <!--Botão para visualizar agendamentos que está alocado-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-nurse"></i>
                            <i class="fas fa-notes-medical"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('meusAgendamentos') }}">Agendamentos e <br>medicamentos que estou alocado</a></h4>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-book-medical"></i>
                        </div>
                        <!----------Card responsável pelo Histórico de Prontuário------------>
                        <h4 class="card-options_title"><a
                            href="{{ route('historicoProntuario') }}">Histórico de prontuário</a></h4>
                    </div>
                </div>
            </div>  
        </div>
  </body>
  </html>