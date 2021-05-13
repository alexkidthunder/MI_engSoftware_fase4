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
    @include('layouts.navbar-enfChefe')
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
              <!--------- Cabeçario --------->
              <div class="title">
                <div class="row">
                    <div class="col-lg-8">
                        NOME
                    </div>
                    <div class="col-lg-4">
                        CARGO
                    </div>
                </div>
              </div>
              <!--------- Plantonista --------->
                <div class="box-blue">
                    <div class="row">
                        <div class="col-lg-8">
                            Rafela Soares da Silva
                        </div>
                        <div class="col-lg-4">
                            Enfermeiro chefe
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>