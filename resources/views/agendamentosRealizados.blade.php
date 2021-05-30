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

    <title>Agendamentos realizados</title>
    
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->

    <div class="container-1">

        <h1>AGENDAMENTOS E MEDICAMENTOS REALIZADOS</h1>

        <!---------------------Agendamento Realizado --------------------->
        @if(isset($infos["medicamento0"]))
        <div class="box-scheduling" id="scheduling">
            <div class="row">
                <!------ Horário da aplicação ---->
                <div class="col-6 col-sm-6 col-md-6 col-lg-2 text-center">
                    <div class="box-gray">
                        {{$infos["hora0"]}}
                    </div>
                </div>
                <!------ Data de aplicação ---->
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
                    <a href="{{ route('prontuario') }}" target="_parent"><button class="btn-Patient">{{$infos["paciente0"]}}</button></a>
                </div>
                <!------ Leito em que o paciente está internado ---->
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="box-blue">
                        Leito: {{$infos["leito0"]}}
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!---------------------Fim de agendamento realizado --------------------->

    </div>
</body>

</html>
