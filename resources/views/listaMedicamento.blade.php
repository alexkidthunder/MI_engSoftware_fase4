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

    <div class="container-1" id="medicament-list">
        <h1>MEDICAMENTOS CADASTRADOS</h1>

            <div class="box-white"> <!--Medicamento listado-->
                <div class="row">
                    <div class="col-lg-12">
                        <label>Nome</label> <br>
                        <div class="box-blue">
                            Nome do medicamento
                        </div>
                    </div>  
                </div>  
                <div class="row">
                    <div class="col-lg-3">
                        <label>Data de validade</label> <br>
                        <div class="box-gray">
                            Data de validade
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label>Em estoque</label> <br>
                        <div class="box-gray">
                            Em estoque
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>Fabricante</label> <br>
                        <div class="box-gray">
                            Descrição
                        </div>
                    </div>
                </div>
            </div>
    </div>  
</body>