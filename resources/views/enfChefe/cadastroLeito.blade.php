<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <title>Cadastro e Remoção de Leitos</title>

</head>


<body>
    <!----------Hearder------------>
    @include('layouts.navbar-enfChefe')
    <!----------End Hearder-------->
    <section> 

        <div class="container-1">
                <h1>CADASTRO DE LEITO</h1>
            <div class="box">
                <br>
                <form id="register">
                    <div class="box-cadastroLeito">
                        <div class="row">
                            <div class="col-lg-4">
                                <div>
                                    <label name="Leito">Leito:</label>
                                    <input type="text" name="Leito" requerid>
                                </div>
                            </div>

                        <button type="submit" class="btn-blue"> Cadastrar </button>
                        </div>
                    </div> 
                </form>      
            </div>         
        </div>      
    </section> 
 </body>
 </html>