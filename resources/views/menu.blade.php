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
                @for($i = 17; $i <=75; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
        
                @for($i = 33; $i <=91; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
        
                <!-- ================================FIM=========================-->

                <!-- ============================ COMUNS AOS TRÊS =========================-->
                @for($i = 18; $i <=76; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
        
                @for($i = 34; $i <=92; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
        
                <!-- ============================ FIM =========================-->

                <!-- ========================== APENAS ENFERMEIRO CHEFE ==================-->
                @for($i = 12; $i <=70; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
        
                <!----------Card responsável por cadastrar os plantonistas------------>
                @for($i = 7; $i <=65; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
        
                <!----------Card responsável por cadastrar os medicamentos------------>
                @for($i = 9; $i <=67; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
        
                <!----------Card responsável pelo Cadastro e Exclusão de Leito------------>
                @for($i = 29; $i <=87; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
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
                @for($i = 14; $i <=72; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor

                <!----------Card responsável para a listagem de medicamentos do sistema----------->
                @for($i = 35; $i <=93; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
                
                <!----------Card responsável por mostrar os responsáveis pelas aplicações de medicamentos------------>
                @for($i = 16; $i <=74; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
                
                <!--============================= FIM ======================================-->

                <!-- ====================== APENAS ENFERMEIRO E ESTAGIARIO ===================-->
                <!--Botão para visualizar agendamentos realizados-->
                @for($i = 22; $i <=80; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
                
                <!--Botão para visualizar agendamentos-->
                @for($i = 15; $i <=73; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor
                
                <!--Botão para visualizar agendamentos que está alocado-->
                @for($i = 23; $i <=81; $i = $i+29)
                @if(isset($resultado[$i]))
                @if($resultado[$i] == 1)
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
                @endif
                @endfor

                <!-- ============================ FIM =========================-->

            </div>  
        </div>
    @endif
  </body>
  </html>