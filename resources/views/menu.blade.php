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
  <body class="body-menu">
    <!----------Hearder------------>
    @include('layouts.navbar-menu')
    <!----------End Hearder-------->
    @if(isset($resultado))
        <div class="container-2">
            <div class="row">
                <!-- ============================ ENFERMEIRO CHEFE E ENFERMEIRO =========================-->
                @if($resultado[17]==1)
                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para cadastro de paciente-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-injured"></i>
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroPaciente') }}">Cadastrar paciente</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                @endif
                @if($resultado[33]==1)
                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para cadastrar prontuário-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-clipboard-list"></i>
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroProntuario') }}">Cadastrar prontuário</a></h4>
                    </div>
                </div>  <!--Fim do Botão-->
                @endif

                <!-- ================================FIM=========================-->

                <!-- ============================ COMUNS AOS TRÊS =========================-->
                @if($resultado[18]==1)
                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para ver pacientes e prontuários-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-injured"></i>
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('pacientes') }}">Pacientes e prontuários</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                @endif
                @if($resultado[34]==1)
                <div class="col-6 col-md-4 col-lg-3"> <!----------Card responsável pelo Histórico de Prontuário------------>
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-book-medical"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('historicoProntuario') }}">Histórico de prontuário</a></h4>
                    </div>
                </div><!--Fim do Botão-->
                @endif
                <!-- ============================ FIM =========================-->

                <!-- ========================== APENAS ENFERMEIRO CHEFE ==================-->
                @if($resultado[12]==1)
                <!----------Card responsável por cadastrar os agendamentos----------->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroAgendamento') }}">Cadastrar agendamentos</a></h4>
                    </div>
                </div> 
                @endif
                <!----------Card responsável por cadastrar os plantonistas------------>
                @if($resultado[7]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-nurse"></i>
                            <i class="fas fa-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroPlantonista') }}">Cadastrar plantonistas</a></h4>
                    </div>
                </div> 
                @endif
                <!----------Card responsável por cadastrar os medicamentos------------>
                @if($resultado[9]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-capsules"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroMedicamento') }}">Cadastrar medicamentos</a></h4>
                    </div>
                </div> 
                @endif
                <!----------Card responsável pelo Cadastro e Exclusão de Leito------------>
                @if($resultado[29]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-procedures"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastroLeito') }}">Cadastrar e Remover leito</a></h4>
                    </div>
                </div>
                @endif
                <!----------Card responsável por listar todos os agendamentos------------>
                @if(isset($_SESSION["enfermeiroChefe"]))
                @if($resultado[15] == 1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <div><i class="fas fa-clipboard"></i></div>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('listaAgendamentos') }}">Listagem de agendamentos</a></h4>
                    </div>
                </div>
                @endif 
                @endif
                <!----------Card responsável por mostrar os Planotnistas------------>
                @if($resultado[14]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('listagemPlantonistas') }}">Plantonistas</a></h4>
                    </div>
                </div> 
                @endif
                <!----------Card responsável para a listagem de medicamentos do sistema----------->
                @if($resultado[35]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-briefcase-medical"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('listaMedicamento') }}">Medicamentos cadastrados</a></h4>
                    </div>
                </div> 
                @endif
                <!----------Card responsável por mostrar os responsáveis pelas aplicações de medicamentos------------>
                @if($resultado[16]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-syringe"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('responsaveis') }}">Responsáveis pela aplicação de medicamentos</a></h4>
                    </div>
                </div> 
                @endif
                <!--============================= FIM ======================================-->

                <!-- ====================== APENAS ENFERMEIRO E ESTAGIARIO ===================-->
                <!--Botão para visualizar agendamentos realizados-->
                @if($resultado[22]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('agendamentosRealizados') }}">Agendamentos realizados</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                @endif

                <!--Botão para visualizar agendamentos-->
                @if($resultado[15]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <div><i class="fas fa-notes-medical"></i></div>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('agendamentos') }}">Agendamentos</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                @endif

                <!--Botão para visualizar agendamentos que está alocado-->
                @if($resultado[23]==1)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-nurse"></i>
                            <i class="fas fa-notes-medical"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('meusAgendamentos') }}">Agendamentos e <br>medicamentos que estou alocado</a></h4>
                    </div>
                </div>
                @endif

                <!-- ============================ FIM =========================-->

            </div>  
        </div>
    @endif
  </body>
  </html>