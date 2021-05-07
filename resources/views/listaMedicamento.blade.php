<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet"> 

    <title>Medicamentos cadastrados</title>
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

    <div class="container-1">
        <h1>MEDICAMENTOS CADASTRADOS</h1>

            <div class="box-scheduling"> <!--Medicamento listado-->
                <div class="row">
                    <div class="col-lg-8 text-center">
                        <div class="box-gray">
                            Nome Medicamento
                        </div>
                    </div>    
                    <div class="col-lg-2">
                        <div class="box-gray text-center">
                            Posologia
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <div class="box-gray">
                            Qtd do Medicamento
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-lg">
                        <div class="box-gray">
                            Descrição
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
</body>