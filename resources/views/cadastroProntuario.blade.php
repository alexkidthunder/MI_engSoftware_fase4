<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
    <script src="{{ 'js/mascara.min.js' }}"></script>

    <title>Cadastro Prontuario</title>

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
            <h1>CADASTRO DE PRONTUARIO</h1>

            <!------------- Busca do paciente ------------->
            <div id="search">
                <div class="box">
                    <div class="content-center">
                        <h3>BUSCAR PACIENTE</h3>
                        <form class="search-bar" action="/buscarPaciente" method="get">
                            <!--- Campo para a inserção do CPF do paciente --->
                            <input id="cpf_user" name="cpf_user" type="text"
                                onkeyup="mascara('###.###.###-##',this,event,true)" required maxlength="14"
                                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="Informe o CPF">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!---------- Fim da Busca do paciente ---------->

            <!----------- MENSAGENS DE ERRO ----------------->
            @if (session('msg-error'))
                <div class='msg-error'> {{ session('msg-error') }}</div>
            @endif
            <!----------- MENSAGENS DE SUCESSO----------------->
            @if (session('msg-sucess'))
                <div class='msg-sucess'> {{ session('msg-sucess') }}</div>
            @endif

            <!---------- Infomações do Paciente buscado ---------->
            @if (isset($paciente))
                <h3>Paciente</h3><br>
                <div class="row">
                    <!------ Nome do Paciente ------>
                    <div class="col-12 col-md-12 col-lg-8">
                        <div class="box-gray">
                            {{ $paciente['Nome_Paciente'] }}
                        </div>
                    </div>
                    <!------ CPF do Paciente ------>
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="box-gray">
                            {{ $paciente['CPF'] }}
                        </div>
                    </div>
                </div>
                <!------ Fim das infomações do Paciente buscado ------>

                <br>
                <!---------- Cadastro do prontuário ---------->
                <form id="register" action="/cadastrarProntuario" method="get">                   
                    <input name="CPF_Paciente" type="hidden" value="{{$paciente['CPF']}}">
                    <div class="box-cadastroLeito">
                        <div class="row">
                            <!------ Nome do leito de internamento do Paciente ------>
                            <div class="col-md-6 col-lg-4">
                                <!------ Aqui em baixo o Leito cadastrado no BD, como isso não ta feito, vai um exemplo ------>
                                <label name="inserir_leito">Selecione o leito</label>
                                <form>
                                    <select id="LeitoSelect" name="Leito">
                                        @if (isset($leitos))
                                            @foreach ($leitos as $leito)
                                                <option value="{{ $leito['Identificacao'] }}">
                                                    {{ $leito['Identificacao'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </form>
                            </div>
                            <!------ Data de internação do Paciente ------>
                            <div class="col-md-6 col-lg-4">
                                <div>
                                    <label name="data_internacao">Data de Internação</label>
                                    <input type="date" name="data_internacao" required>
                                </div>
                            </div>
                        </div>
                        <!------ Botão para cadastrar ------>
                        <div>
                            <button type="submit" class="btn-blue"> Cadastrar </button>
                        </div>
                    </div>
                </form>
            @endif
            <!---------- Fim do cadastro do prontuário ---------->
        </div>
    </section>
</body>

</html>
