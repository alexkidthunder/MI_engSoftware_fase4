<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/navbar-style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
    <script src="{{ ('js/navbar.js') }}" defer></script>

</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">

                <!-------- Nome do funcionário e acesso ao perfil -------->
                <div class="d-flex">
                    <a name="nav-item" href="{{ route('editarPerfil') }} " class="user"> <i class="fas fa-user"></i></a>
                    <div class="col-lg-3">
                        @if (isset($_SESSION['administrador']))
                            <h2><a name="nav-item" href="{{ route('editarPerfil') }}">{{ $_SESSION['administrador'] }}</a></h2>
                        @endif
                    </div>
                </div>
                <nav class="nav d-lg-block">
                    <input type="checkbox" id="check-options">
                    <label for="check-options" class="menu-items"><i class="fas fa-bars"></i></label>
                    <ul>
                        <li class="title-nav"><a name="nav-item" href="{{ route('menuAdm') }}">INÍCIO</a></li>
                        <li class="drop-down title-nav"><a>FUNCIONÁRIOS <i class="fas fa-angle-down"></i></a>
                            <ul>
                                <li><a name="nav-item" href="{{ route('cadastrarUsuario') }}">Cadastrar</a></li>
                                <li><a name="nav-item" href="{{ route('removerUsuario') }}">Remover</a></li>
                                <li><a name="nav-item" href="{{ route('editarAtribuicao') }}">Alterar atribuição</a></li>
                                <li><a name="nav-item" href="{{ route('editarPermissao') }}">Alterar permissões</a></li>
                            </ul>
                        </li>

                        <li class="title-nav"><a name="nav-item" href="{{ route('log') }}">LOG DO SISTEMA</a></li>

                        <li class="title-nav"><a name="nav-item" href="{{ route('backup') }}">BACKUP</a></li>

                        <li class="title-nav"><a name="nav-item" href="#">RELATÓRIOS GERENCIAIS</a></li>

                        <!-------- Botão de logout -------->
                        <li><a name="nav-item" href="/logout" class="logout-icon"><i class="fas fa-sign-out-alt"></i></a></li>

                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <script src="jquery.min.js"></script>
    <script>
        $('.nav').on('click','li', function(){
            $('.nav .active').removeClass('active');
            $(this).addClass('active');
        });
    </script>

</body>

</html>
