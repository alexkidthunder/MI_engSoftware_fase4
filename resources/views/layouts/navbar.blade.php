<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/navbar-style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
    <script src="{{ ('js/navbar.js') }}" defer></script>

</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container-fluid">

            <!-------- Nome do funcionário e acesso ao perfil -------->
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex">
                    <a name="nav-item" href="{{ route('editarPerfil') }} " class="user"> <i class="fas fa-user"></i></a>
                    <div class="col-lg-3">
                        @if (isset($_SESSION['enfermeiro']))
                            <h2><a name="nav-item" href="{{ route('editarPerfil') }}">{{ $_SESSION['enfermeiro'] }}</a></h2>
                        @endif
                        @if (isset($_SESSION['estagiario']))
                            <h2><a name="nav-item" href="{{ route('editarPerfil') }}">{{ $_SESSION['estagiario'] }}</a></h2>
                        @endif
                        @if (isset($_SESSION['enfermeiroChefe']))
                            <h2><a name="nav-item" href="{{ route('editarPerfil') }}">{{ $_SESSION['enfermeiroChefe'] }}</a></h2>
                        @endif
                    </div>
                </div>
                
                <!---------------- Opções do menu ---------------->
                <nav class="nav d-lg-block" id="nav">
                    <button class="menu-items" id="check-options" ><i class="fas fa-bars"></i></button>

                    <ul id="menu">
                        <li class="title-nav"><a name="nav-item" href="{{ route('menu') }}">INÍCIO</a></li>

                        <li class="drop-down title-nav"><a>PACIENTES <i class="fas fa-angle-down"></i></a>
                            <ul>
                                <!-- Apenas enfermeiro e enfermeiro chefe-->
                                @if (isset($_SESSION['estagiario']) == false)
                                    <li><a name="nav-item" href="{{ route('cadastroPaciente') }}">Cadastro de pacientes</a></li>
                                    <li><a name="nav-item" href="{{ route('cadastroProntuario') }}">Cadastro de prontuário</a></li>
                                @endif
                                <!-- Comum a enfermeiro, estagiário e enfermeiro chefe -->
                                <li><a name="nav-item" href="{{ route('pacientes') }}">Pacientes e prontuários</a></li>
                                <li><a name="nav-item" href="{{ route('historicoProntuario') }}">Histórico de prontuários</a></li>
                            </ul>
                        </li>


                        <li class="drop-down title-nav"><a>AGENDAMENTOS E<br> MEDICAMENTOS <i
                                    class="fas fa-angle-down"></i></a>
                            <ul>
                                <!-- Comum a enfermeiro e estagiário -->
                                @if (isset($_SESSION['enfermeiroChefe']) == false)
                                    <li><a name="nav-item" href="{{ route('agendamentos') }}">Verificação de agendamentos</a></li>
                                    <li><a name="nav-item" href="{{ route('meusAgendamentos') }}">Meus agendamentos</a></li>
                                    <li><a name="nav-item" href="{{ route('agendamentosRealizados') }}">Meus agendamentos
                                            realizados</a>
                                    </li>
                                @endif
                                <!-- Enfermeiro chefe-->
                                @if (isset($_SESSION['enfermeiroChefe']))
                                    <li><a name="nav-item" href="{{ route('cadastroAgendamento') }}">Cadastro de agendamentos</a>
                                    </li>
                                    <li><a name="nav-item" href="{{ route('listaAgendamentos') }}">Listagem de agendamentos</a></li>
                                    <li><a name="nav-item" href="{{ route('cadastroMedicamento') }}">Cadastro de medicamentos</a>
                                    </li>
                                    <li><a name="nav-item" href="{{ route('listaMedicamento') }}">Medicamentos cadastados</a></li>
                                    <li><a name="nav-item" href="{{ route('responsaveis') }}">Responsáveis por aplicação</a></li>
                                @endif
                            </ul>
                        </li>

                        @if (isset($_SESSION['enfermeiroChefe']))
                            <li class="drop-down title-nav"><a>LEITOS <i class="fas fa-angle-down"></i></a>
                                <ul>
                                    <li><a name="nav-item" href="{{ route('cadastroLeito') }}">Cadastro e remoção de leito</a>
                                    </li>
                                </ul>
                            </li>


                            <li class="drop-down title-nav"><a>PLANTONISTAS <i class="fas fa-angle-down"></i></a>
                                <ul>
                                    <li><a name="nav-item" href="{{ route('cadastroPlantonista') }}">Cadastro de plantonista</a>
                                    </li>
                                    <li><a name="nav-item" href="{{ route('listagemPlantonistas') }}">Listagem de
                                            plantonista</a></li>
                                </ul>
                            </li>
                        @endif
                        <!-------- Botão de logout -------->
                        <li><a name="nav-item" href="/logout" class="logout-icon"> <i class="fas fa-sign-out-alt"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
</body>

</html>
