<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <title>Medicamentos cadastrados</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->

    <!----------Botão de donwload------------>
    <div id="screen-icon">
        <form class="download-icon">
            <button>
                <i class="fas fa-download"></i>
            </button>
        </form>
    </div>
    <!--------Fim do botão de donwload-------->

    <div class="container-1" id="medicament-list">
        <h1>MEDICAMENTOS CADASTRADOS</h1>

        <!-------------- Medicamento 1 -------------->
        <div class="box-white">
            <!----- Nome do medicamento----->
            <div class="row">
                <div class="col-lg-12">
                    <label>Nome</label> <br>
                    <div class="box-blue">
                        Anlodipino
                    </div>
                </div>
            </div>
            <div class="row">
                <!----- Data de validade do medicamento----->
                <div class="col-lg-3">
                    <label>Data de validade</label> <br>
                    <div class="box-gray">
                        01/10/2021
                    </div>
                </div>
                <!-----Quantidade do medicamento----->
                <div class="col-lg-3">
                    <label>Em estoque</label> <br>
                    <div class="box-gray">
                        100
                    </div>
                </div>
                <!-----Fabricante do medicamento----->
                <div class="col-lg-6">
                    <label>Fabricante</label> <br>
                    <div class="box-gray">
                        União MDN
                    </div>
                </div>
            </div>
        </div>
        <!-------------- Fim do medicamento 1 -------------->

        <!-------------- Medicamento 2 -------------->
        <div class="box-white">
            <!----- Nome do medicamento----->
            <div class="row">
                <div class="col-lg-12">
                    <label>Nome</label> <br>
                    <div class="box-blue">
                        Dipirona
                    </div>
                </div>
            </div>
            <div class="row">
                <!----- Data de validade do medicamento----->
                <div class="col-lg-3">
                    <label>Data de validade</label> <br>
                    <div class="box-gray">
                        10/03/2022
                    </div>
                </div>
                <!-----Quantidade do medicamento----->
                <div class="col-lg-3">
                    <label>Em estoque</label> <br>
                    <div class="box-gray">
                        250
                    </div>
                </div>
                <!-----Fabricante do medicamento----->
                <div class="col-lg-6">
                    <label>Fabricante</label> <br>
                    <div class="box-gray">
                        União MDN
                    </div>
                </div>
            </div>
        </div>
        <!-------------- Fim do medicamento 2 -------------->
    </div>
</body>

</html>
