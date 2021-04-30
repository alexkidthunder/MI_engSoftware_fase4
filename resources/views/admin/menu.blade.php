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
    <!----------Hearder------------>
    @include('layouts.navbar-menu')
    <!----------End Hearder-------->

        <div class="container-2">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastrarUsuario') }}">Cadastro de funcionários</a></h4>
                    </div>
                </div> 
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                            <i class="fas fa-user-minus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('removerUsuario') }}">Remoção de funcionários</a></h4>
                    </div>
                </div> 
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('log') }}">Log do sistema</a></h4>
                    </div>
                </div> 

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('editarPermissao') }}">Alterar pemissões <br>de cargos</a></h4>
                    </div>
                </div> 

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('editarAtribuicao') }}">Alterar atribuição <br>de funcionários</a></h4>
                    </div>
                </div> 

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('backup') }}">Backup do sistema</a></h4>
                    </div>
                </div> 
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="#">Relatórios gerenciais</a></h4>
                    </div>
                </div> 
            </div>
        </div>   
  </body>
