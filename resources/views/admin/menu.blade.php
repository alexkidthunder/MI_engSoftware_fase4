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
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastrarUsuario') }}">Cadastro de funcionários</a></h4>
                    </div>
                </div> 
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('removerUsuario') }}">Remoção de funcionários</a></h4>
                    </div>
                </div> 
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('log') }}">Log do sistema</a></h4>
                    </div>
                </div> 

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('editarPermissao') }}">Alterar pemissões <br>de cargos</a></h4>
                    </div>
                </div> 

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('editarAtribuicao') }}">Alterar atribuição <br>de funcionários</a></h4>
                    </div>
                </div> 

                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('backup') }}">Backup do sistema</a></h4>
                    </div>
                </div> 
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="card-menu text-center card-options">
                        <div class="card-options_img">
                            <img class="options-img " src="imagemOficial.jpg">
                        </div>
                        <h4 class="card-options_title"><a
                            href="#">Relatórios gerenciais</a></h4>
                    </div>
                </div> 
            </div>  
        </div>

        <div><i class="fas fa-user-plus">Add</i></div>
        <div><i class="fas fa-user-edit">editar</i></div>
        <div><i class="fas fa-user-minus">Remover</i></div>
    
        <div><i class="fas fa-edit"></i></div>
        <div><i class="fas fa-database"></i></div>
        <div><i class="fas fa-cogs"></i></div>
    
        <div><i class="fas fa-list"></i></div>
    
        
        <div><i class="fas fa-angle-down"></i></div>
        <div><i class="fas fa-bars"></i></div>
        <div><i class="fas fa-briefcase-medical"></i></div>
        <div><i class="fas fa-calendar-plus"></i>cadastrar agendamento</div>
        <div><i class="fas fa-capsules"></i>medicamento</div>
        <div><i class="fas fa-check-square"></i></div>
        <div><i class="fas fa-clipboard-check"></i></div>
        
        <div><i class="fas fa-clipboard-list"></i></div>
        <div><i class="fas fa-edit"></i></div>
        <div><i class="fas fa-file-download"></i></div>
        <div><i class="fas fa-file-contract"></i></div>
        <div><i class="fas fa-file-medical"></i></div>
        <div><i class="fas fa-file-medical-alt"></i></div>
        <div><i class="fas fa-first-aid"></i></div>
        <div><i class="fas fa-"></i></div>
        <div><i class="fas fa-"></i></div>
  </body>
