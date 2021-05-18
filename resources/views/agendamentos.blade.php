<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="{{ asset(' ') }}" rel="icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ 'js/agendamentos.js' }}" defer></script>

    <title>Meus agendamentos</title>

</head>
<!--ENFERMEIRO E ESTAGIARIO -->

<body>
    <!----------Hearder------------>
    @if (isset($_SESSION['enfermeiro']))
        @include('layouts.navbar')
    @endif
    @if (isset($_SESSION['enfermeiroChefe']))
        @include('layouts.navbar-enfChefe')
    @endif
    @if (isset($_SESSION['estagiario']))
        @include('layouts.navbar')
    @endif
    <!----------End Hearder-------->
    <section>

        <div class="container-1" id="scheduling">
            <h1>VERIFICAÇÃO DE AGENDAMENTOS</h1>

            <!---------------------- Agendamento 1 ---------------------->
            <div class="box-scheduling">
                <!----- Fim das informações do agendamento ----->
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <!------ Horário previsto para o agendamento ---->
                        <div class="box-gray">
                            22:30h
                        </div>
                    </div>
                    <!------ Data prevista para o agendamento ---->
                    <div class="col-lg-2 text-center">
                        <div class="box-gray">
                            13/05/2021
                        </div>
                    </div>
                    <!------ Nome do medicamento ---->
                    <div class="col-lg-6">
                        <div class="box-white">
                            Alodipina
                        </div>
                    </div>
                    <!------ Posologia do medicamento ---->
                    <div class="col-lg-2">
                        <div class="box-white">
                            10 ml
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!------ Nome do paciente ao qual o agendamento pertence ---->
                    <div class="col-lg-9">
                        <a href="{{ route('prontuario') }}" target="_parent"><button
                                class="btn-Patient text-left">Marcos Antonio de Oliveira</button></a>
                    </div>
                    <!------ Leito em que o paciente está internado ---->
                    <div class="col-lg-3">
                        <div class="box-blue">
                            Leito: LC005
                        </div>
                    </div>
                </div>
                <!---- Fim das informações do agendamento ------>


                <div class="row">
                    <!--------------- Preprador da aplicação --------------->

                    <!---------- Nome do preparador ---------->
                    <div class="col-lg-2 hide" name="preparador_div">
                        <p>Prepador da aplicação:</p>
                    </div>
                    <div class="col-lg-7 hide" name="preparador_div">
                        <!--Utilizar Jquery (inner.html)-->
                        <div class="box-gray" id="preparador">

                        </div>
                    </div>
                    <!---------- Botao para adicionar preparador ---------->
                    <div class="col-lg-3" id="add_prep_btn_div">
                        <div>
                            <button type="button" class="btn-white" id="add_prep_btn"> Adicionar preparador</button>
                        </div>
                    </div>
                    <!------------- Fim do preprador da aplicação ------------->

                    <!---------- Botao para finalizar aplicação---------->
                    <div class="col-lg-3 hide" id="end_prep_div">
                        <div>
                            <button type="button" class="btn-white" id="end_prep_btn"> Finalizar aplicação</button>
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------- Fim do agendamento 1---------------------->

            <!---------------------- Agendamento 2 ---------------------->
            <div class="box-scheduling">
                <!----- Fim das informações do agendamento ----->
                <div class="row">
                    <div class="col-lg-2 text-center">
                        <!------ Horário previsto para o agendamento ---->
                        <div class="box-gray">
                            04:00h
                        </div>
                    </div>
                    <!------ Data prevista para o agendamento ---->
                    <div class="col-lg-2 text-center">
                        <div class="box-gray">
                            14/05/2021
                        </div>
                    </div>
                    <!------ Nome do medicamento ---->
                    <div class="col-lg-6">
                        <div class="box-white">
                            Dipirona
                        </div>
                    </div>
                    <!------ Posologia do medicamento ---->
                    <div class="col-lg-2">
                        <div class="box-white">
                            20 ml
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!------ Nome do paciente ao qual o agendamento pertence ---->
                    <div class="col-lg-9">
                        <a href="{{ route('prontuario') }}" target="_parent"><button
                                class="btn-Patient text-left">Roseane Neves da Paixão</button></a>
                    </div>
                    <!------ Leito em que o paciente está internado ---->
                    <div class="col-lg-3">
                        <div class="box-blue">
                            Leito: LC003
                        </div>
                    </div>
                </div>
                <!---- Fim das informações do agendamento ------>


                <div class="row">
                    <!--------------- Preprador da aplicação --------------->

                    <!---------- Nome do preparador ---------->
                    <div class="col-lg-2 hide" name="preparador_div">
                        <p>Prepador da aplicação:</p>
                    </div>
                    <div class="col-lg-7 hide" name="preparador_div">
                        <!--Utilizar Jquery (inner.html)-->
                        <div class="box-gray" id="preparador">

                        </div>
                    </div>
                    <!---------- Botao para adicionar preparador ---------->
                    <div class="col-lg-3" id="add_prep_btn_div">
                        <div>
                            <button type="button" class="btn-white" id="add_prep_btn"> Adicionar preparador</button>
                        </div>
                    </div>
                    <!------------- Fim do preprador da aplicação ------------->

                    <!---------- Botao para finalizar aplicação---------->
                    <div class="col-lg-3 hide" id="end_prep_div">
                        <div>
                            <button type="button" class="btn-white" id="end_prep_btn"> Finalizar aplicação</button>
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------- Fim do agendamento 2---------------------->
        </div>
    </section>
</body>

</html>
