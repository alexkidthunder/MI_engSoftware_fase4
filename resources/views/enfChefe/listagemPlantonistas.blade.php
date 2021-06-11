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
    {{$i = 0}}
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
                <!--------- Cabeçalho --------->
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
                @while(isset($plantonista["nome".$i]))
                <!--------- Plantonista --------->
                <div class="box-blue">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-8 col-lg-8 text-left">
                            {{$plantonista["nome".$i]}}
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4 text-left">
                            {{$plantonista["cargo".$i]}}
                        </div>
                        {{$i++}}
                    </div>
                </div>
                <!------- Fim de plantonista ------->
                @endwhile
            </div>
        </div>
    </section>
</body>

</html>
