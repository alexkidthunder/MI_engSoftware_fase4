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
                <!--------- Cabeçario --------->
                <div class="title">
                    <div class="row">
                        <div class="col-lg-6">
                            NOME
                        </div>
                        <div class="col-lg-3">
                            CARGO
                        </div>
                        <div class="col-lg-3" align="center">
                            EM PLANTÃO
                        </div>
                    </div>
                </div>
                <!--------- Plantonista --------->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="box-blue">
                            Rafela Soares da Silva
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box-blue">
                            Enfermeiro chefe
                        </div>
                    </div>
                    <div class="col-lg-3" align="center">
                      <div class="box-button">
                        <input type="checkbox">
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>