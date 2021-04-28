<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <title>Menu</title>
  </head>
  <body class="body-menu" hrfe = '/sessaoAdmin'>
    <header class="header-adm">
        <a href="/">Nome Funcionário</a>
    </header>

        <div class="container-2">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastrarUsuario') }}">Cadastro de funcionários</a></h4>
                    </div>
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('removerUsuario') }}">Remoção de funcionários</a></h4>
                    </div>
                </div> 
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('log') }}">Log do sistema</a></h4>
                    </div>
                </div> 

                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('editarPermissao') }}">Alterar pemissões de cargos</a></h4>
                    </div>
                </div> 

                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('editarAtribuicao') }}">Alterar atribuição de funcionários</a></h4>
                    </div>
                </div> 

                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('backup') }}">Backup do sistema</a></h4>
                    </div>
                </div> 
            </div>  
        </div>
  </body>
