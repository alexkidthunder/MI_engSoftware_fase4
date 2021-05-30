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

    <title>Agendamentos</title>

</head>
<!--ENFERMEIRO E ESTAGIARIO -->

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    
    <section>

        <div class="container-1" id="scheduling">
            <h1>VERIFICAÇÃO DE AGENDAMENTOS</h1>

            <!---------------------- Agendamento  ---------------------->
            @if(isset($infos["medicamento0"]))
            <div class="box-scheduling" id="scheduling">
                <!----- Fim das informações do agendamento ----->
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2 text-center">
                        <!------ Horário previsto para o agendamento ---->
                        <div class="box-gray">
                            {{$infos["hora0"]}}
                        </div>
                    </div>
                    <!------ Data prevista para o agendamento ---->
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2 text-center">
                        <div class="box-gray">
                            {{$infos["data0"]}}
                        </div>
                    </div>
                    <!------ Nome do medicamento ---->
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="box-white">
                            {{$infos["medicamento0"]}}
                        </div>
                    </div>
                    <!------ Posologia do medicamento ---->
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2">
                        <div class="box-white">
                            {{$infos["posologia0"]}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!------ Nome do paciente ao qual o agendamento pertence ---->
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                        <a href="{{ route('prontuario') }}" target="_parent"><button
                                class="btn-Patient">{{$infos["paciente0"]}}</button></a>
                    </div>
                    <!------ Leito em que o paciente está internado ---->
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="box-blue">
                            Leito: {{$infos["leito0"]}}
                        </div>
                    </div>
                </div>
                
                <!---- Fim das informações do agendamento ------>


                <div class="row">
                    <!--------------- Preprador da aplicação --------------->

                    <!---------- Nome do preparador ---------->
                    <div class="col-12 col-sm-12 col-md-3 col-lg-2 hide" name="preparador_div">
                        <p>Prepador da aplicação:</p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-9 col-lg-7 hide" name="preparador_div">
                        <!--Utilizar Jquery (inner.html)-->
                        <div class="box-gray" id="preparador">
                        </div>
                    </div>
                    <!---------- Botao para adicionar preparador ---------->
                    <div class="col-lg-9">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3" id="add_prep_btn_div">
                        <div>
                            <button type="button" class="btn-white" id="add_prep_btn"> Adicionar preparador</button>
                        </div>
                    </div>
                    <!------------- Fim do preprador da aplicação ------------->

                    <!---------- Botao para finalizar aplicação---------->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 hide" id="end_prep_div">
                        <div>
                            <button href = "/agendamentos" type="submit" class="btn-white" id="end_prep_btn"> Finalizar aplicação</button>
                        </div>
                    </div>
                </div>
            </div>
            <!---------------------- Fim do agendamento ---------------------->
        </div>
        @endif
    </section>
</body>

</html>
