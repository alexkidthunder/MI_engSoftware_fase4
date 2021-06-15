<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ 'js/cadastroAgendamento.js' }}" defer></script>
    <script src="{{ 'js/mascara.min.js' }}"></script>

    <title>Cadastro Agendamento</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->

    <!---------------Notificação para o usuário-------------->
    @if(isset($_SESSION['notifi']))
    @if(!empty ($_SESSION['notifi']))
    <div id="notification">
        <div class='msg-notification'>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12 col-sm-12">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="col-lg-8 col-md-8 col-10 col-sm-10">
                    {{$_SESSION['notifi']}} 
                </div>
                <form action="/apagarN" method="get">
                    <div class="col-lg-2 col-md-2 col-2 col-sm-2">
                        <button name="fechar" type="submit" class="btn-close" id="close"><i class="fas fa-times"></i></button>
                    </div>
                </form>
            </div>
        </div>
    <div>
    @endif
    @endif
    <!---------------Fim de notificação-------------->

    <section>
        <div class="container-1">
            <h1>CADASTRO DE AGENDAMENTO</h1>
            <div class="box">
                <!------------- Busca do paciente ------------->
                <div id="search">
                    <div class="content-center">
                        <h3>BUSCAR PACIENTE</h3>
                        <form class="search-bar" action="buscarPacienteAg" method="get">
                            <input id="cpf_user" name="cpf_user" type="text"
                                onkeyup="mascara('###.###.###-##',this,event,true)" required maxlength="14"
                                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="Informe o CPF">
                            <button type="submit" id="busca_user">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!------------- fim da Busca do paciente ------------->

                <!----------- MENSAGENS DE ERRO ----------------->
                @if (session('msg-error'))
                    <div class='msg-error'> {{ session('msg-error') }}</div>
                @endif
                <!----------- MENSAGENS DE SUCESSO----------------->
                @if (session('msg-sucess'))
                    <div class='msg-sucess'> {{ session('msg-sucess') }}</div>
                @endif

                <!---------------------Infomações do Paciente---------------->
                <!-- <div class="hide" id="user_Data"> -->
                    @if(isset($paciente))
                    <h3>Paciente</h3><br>
                    <div class="box-gray">
                        {{$paciente['Nome_Paciente']}}
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="box-gray">
                                {{$paciente['Cpfpaciente']}}
                            </div>
                        </div>                       
                        <div class="col-lg-4">
                            <div class="box-gray">
                                Leito: {{$paciente['Id_leito']}}
                            </div>
                        </div>
                    </div>
                    <br>
               <!-- </div> -->
                <!---------- Inicio de Cadastro de Agendamento ---------->
                <div>
                <form id="register" action="cadastrarAgendamento" method="get"> 
                        <!--class="hide"-->
                        <input type="hidden" name="Cpf_Paciente" value=" {{ $paciente['Cpfpaciente'] }}">
                        
                        <div class="box-medicament">
                        <input type="hidden" value="{{$paciente['Cpfpaciente']}}">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <!----------Inserção de Horario do Agendamento------------>
                                    <label for="horario_agendamento">Horario</label>
                                    <input type="time" name="horario_agendamento" required>
                                </div>
                                <!----------Inserção da Data do Agendamento------------>
                                <div class="col-md-6 col-lg-4">
                                    <label for="data_agendamento">Data</label>
                                    <input type="date" name="data_agendamento" required>
                                </div>
                                <!----------Inserção da dosagem de medicamento aplicada naquele agendamento------------>
                                <div class="col-lg-4">
                                    <label for="posologia_agendamento">Posologia</label>
                                    <input type="number" name="posologia_agendamento" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="medicamento_agendamento">Medicamento</label>
                                    <!--Front precisa de uma lista de todos os medicamentos. Ps: em Json-->
                                    <input type="text" name="medicamento_agendamento" id="medicamento_agendamento" list="listaMedicamentos">
                                    <!-- Auto Complete Lista de medicamentos  -->
                                    <datalist id="listaMedicamentos">
                                            @if(isset($medicamentos))
                                            @foreach($medicamentos as $medicamento)
                                            <option>{{$medicamento['Nome_Medicam']}} </option>                                 
                                            @endforeach
                                            @endif
                                        </datalist>                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <!----------Inicio de alocação de aplicador------------>
                                    <label for="aplicador_agendamento">Aplicador</label>
                                    <input id="aloc_inp" type="text" name="aplicador_agendamento"
                                        placeholder="nome do aplicador" list="listaPlantonistas">
                                         <!-- Auto Complete Lista de plantonistas  -->
                                        <datalist id="listaPlantonistas">
                                            @if(isset($plantonistas))
                                            @foreach($plantonistas as $plantonista)
                                            <option>{{$plantonista['Nome_Plantonista']}} </option>                                 
                                            @endforeach
                                            @endif
                                        </datalist>
                                </div>
                               <!-- <div class="col-lg-4">
                                    <br>
                                    <button id="aloc_btn" type="button" class="btn-white"> Alocar aplicador </button>
                                </div> -->
                                <!----------Fim de alocação de aplicador------------>
                            </div>
                        </div>
                        <div>
                            <button id="submit_agendamento" type="submit" class="btn-blue"> Cadastrar </button>
                        </div>

                    </form>
                    <!----------Fim de cadastro de agendamento------------>
                </div>
                @endif
            </div>
        </div>
    </section>
</body>

</html>
