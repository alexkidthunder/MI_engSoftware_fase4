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
        <div id="screen-icon"> <!-- Icone de Download Em Telas -->
            <form class="download-icon">
                <button>
                    <i class="fas fa-download"></i>
                </button>
            </form>
        </div>

    <section>
        <div class="container-1" id="on-duty">
            <h1>LISTAGEM DE PLANTONISTA</h1>

            <div class="box-on-duty">
                <div class="row">
                    <div class="col">
                        <!--------- Cabeçario - Nome --------->
                        <div class="row no-gutters title">
                            <div class="col">
                                NOME
                            </div>
                        </div>
                        <!--------- Nome do Plantonista --------->
                        <div class="row no-gutters box-blue">
                            <div class="col">
                                <p><nobr>Rafaela Soares da Silva</nobr></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <!--------- Cabeçario - Cargo --------->
                        <div class="row no-gutters title">
                            <div class="col">
                                CARGO
                            </div>
                        </div>
                        <!--------- Cargo do Plantonista --------->
                        <div class="row no-gutters box-blue">
                            <div class="col">
                                <p><nobr>Enfermeiro Chefe</nobr></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>