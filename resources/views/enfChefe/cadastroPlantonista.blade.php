<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
    <title>Cadastro Plantonista</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <section>
        <div class="container-1" id="on-duty">
            <h1>PLANTONISTAS</h1>

            <div class="box-on-duty">
                <div class="row">
                    <div class="col"> <!--NOME-->
                        <div class="row no-gutters title"> <!--CABEÇÁRIO NOME-->
                            NOME
                        </div>
                        <div class="row no-gutters box-blue"> <!--FUNCIONÁRIO NOME-->
                            <nobr>Rafela Soares da Silva</nobr>
                        </div>
                    </div>
                    <div class="col"> <!--CARGO-->
                        <div class="row no-gutters title"> <!--CABEÇÁRIO CARGO -->
                            CARGO
                        </div>
                        <div class="row no-gutters box-blue"> <!--FUNCIONÁRIO CARGO -->
                            <nobr>Enfermeiro Chefe</nobr>
                        </div>
                    </div>
                    <div class="col"> <!--EM PLANTÃO-->
                        <div class="row no-gutters title"> <!--align="center"-->
                            <div class="mx-auto">
                                <nobr>EM PLANTÃO</nobr> <!--CABEÇÁRIO EM PLANTÃO -->
                            </div>
                        </div>
                        <div class="row no-gutters box-button"> <!--FUNCIONÁRIO EM PLANTÃO-->
                            <input type="checkbox" class="mx-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>