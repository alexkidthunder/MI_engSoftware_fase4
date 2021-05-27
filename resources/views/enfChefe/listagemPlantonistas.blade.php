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

    <title>Listagem Plantonista</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <div id="screen-icon">
        <!-- Icone de Download Em Telas -->
        <form class="download-icon">
            <button>
                <i class="fas fa-download"></i>
            </button>
        </form>
    </div>

    <section>
        <div class="container-1" id="on-duty">
            <h1 class="title-download">LISTAGEM DE PLANTONISTA</h1>
            <div class="box-on-duty">
                <!--------- Cabeçario --------->
                <div class="title">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-8 col-lg-8">
                            NOME
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                            CARGO
                        </div>
                    </div>
                </div>
                @if(isset($plantonista["nome0"]))
                <!--------- Plantonista --------->
                <!---APENAS ISSO QUE SE REPETE BACK, O CABEÇARIO N -->
                <div class="box-blue">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-8 col-lg-8 text-left">
                            {{$plantonista["nome0"]}}
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4 text-left">
                            {{$plantonista["cargo0"]}}
                        </div>
                    </div>
                </div>
                <!------- Fim de plantonista ------->
                @endif
                @if(isset($plantonista["nome1"]))
                <!--------- Plantonista --------->
                <!---APENAS ISSO QUE SE REPETE BACK, O CABEÇARIO N -->
                <div class="box-blue">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-8 col-lg-8 text-left">
                            {{$plantonista["nome1"]}}
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4 text-left">
                            {{$plantonista["cargo1"]}}
                        </div>
                    </div>
                </div>
                <!------- Fim de plantonista ------->
                @endif
                @if(isset($plantonista["nome2"]))
                <!--------- Plantonista --------->
                <!---APENAS ISSO QUE SE REPETE BACK, O CABEÇARIO N -->
                <div class="box-blue">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-8 col-lg-8 text-left">
                            {{$plantonista["nome2"]}}
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4 text-left">
                            {{$plantonista["cargo2"]}}
                        </div>
                    </div>
                </div>
                <!------- Fim de plantonista ------->
                @endif
            </div>
        </div>
    </section>
</body>

</html>
