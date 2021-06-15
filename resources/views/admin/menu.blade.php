
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <title>Menu</title>
  </head>
  <body class="body-menu">
    <!----------Hearder------------>
    @include('layouts.navbar-menu')
    <!----------End Hearder-------->

    <!---------------Notificação para o usuário-------------->
    @if(isset($_SESSION['notifi']))
    @if(!empty ($_SESSION['notifi']))
    <div id="notification">
        <div class='msg-notification'>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12 col-sm-12">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="col-lg-8 col-md-8 col-10 col-sm-10">
                    {{$_SESSION['notifi']}} 
                </div>
                <form action="/apagarN" method="get">
                    <div class="col-lg-2 col-md-2 col-2 col-sm-2">
                        <button name="fechar" type="submit" class="btn-close" id="close"><i class="fas fa-times"></i></button>
                    </div>
                </form>
            </div>
        </div>
    <div>
    @endif
    @endif
    <!---------------Fim de notificação-------------->

        <div class="container-2"> <!--Menu do Administrador-->
            <div class="row">
                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para cadastro de funcionários-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('cadastrarUsuario') }}">Cadastro de funcionários</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para remoção de funcionários-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-minus"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('removerUsuario') }}">Remoção de funcionários</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para Log do Sistema-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('log') }}">Log do sistema</a></h4>
                    </div>
                </div> <!--Fim do Botão-->

                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para Alterar Permissão funcionários-->
                    <div class="card-menu text-center card-options"> 
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('editarPermissao') }}">Alterar pemissões <br>de cargos</a></h4>
                    </div>
                </div> <!--Fim do Botão-->

                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para Alterar Atribuição de funcionário-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('editarAtribuicao') }}">Alterar atribuição <br>de funcionários</a></h4>
                    </div>
                </div> <!--Fim do Botão-->

                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para backup do sistema-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('backup') }}">Backup do sistema</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
                <div class="col-6 col-md-4 col-lg-3"> <!--Botão para relatórios gerenciais-->
                    <div class="card-menu text-center card-options">
                        <div class="card-options-icon options-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h4 class="card-options_title"><a
                            href="{{ route('relatorioGerencial') }}">Relatórios gerenciais</a></h4>
                    </div>
                </div> <!--Fim do Botão-->
            </div>
        </div>   
  </body>
</html>