<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/navbar-style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between">

                <!-------- Nome do funcionário e acesso ao perfil -------->
                <div class="d-flex">
                    <a href="{{ route('editarPerfil') }} " class="user"> <i class="fas fa-user"></i></a>
                    <div class="col-lg-3">
                        @if (isset($_SESSION['administrador']))
                            <h2><a href="{{ route('editarPerfil') }}">{{ $_SESSION['administrador'] }}</a></h2>
                        @endif
                    </div>
                </div>

                <div class="d-flex align-items-center pr-5">
                    <nav class="nav d-none d-lg-block">

                        <ul>
                            <li class="title-nav"><a href="{{ route('menuAdm') }}">INÍCIO</a></li>
                            <li class="drop-down title-nav"><a>FUNCIONÁRIOS <i class="fas fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="{{ route('cadastrarUsuario') }}">Cadastrar</a></li>
                                    <li><a href="{{ route('removerUsuario') }}">Remover</a></li>
                                    <li><a href="{{ route('editarAtribuicao') }}">Alterar atribuição</a></li>
                                    <li><a href="{{ route('editarPermissao') }}">Alterar permissões</a></li>
                                </ul>
                            </li>

                            <li class="title-nav"><a href="{{ route('log') }}">LOG DO SISTEMA</a></li>

                            <li class="title-nav"><a href="{{ route('backup') }}">BACKUP</a></li>

                            <li class="title-nav"><a href="#">RELATÓRIOS GERENCIAIS</a></li>

                            <!-------- Botão de logout -------->
                            <li><a href="/logout" class="logout-icon"><i class="fas fa-sign-out-alt"></i></a></li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ======= Header ======= -->
    {{-- <header id="header" class="fixed-top ">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-9 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="index.html">Techie</a></h1>
         
          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li class="active"><a href="index.html">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#services">Services</a></li>
              <li><a href="#portfolio">Portfolio</a></li>
              <li><a href="#team">Team</a></li>
              <li class="drop-down"><a href="">Drop Down</a>
                <ul>
                  <li><a href="#">Drop Down 1</a></li>
                  <li class="drop-down"><a href="#">Deep Drop Down</a>
                    <ul>
                      <li><a href="#">Deep Drop Down 1</a></li>
                      <li><a href="#">Deep Drop Down 2</a></li>
                      <li><a href="#">Deep Drop Down 3</a></li>
                      <li><a href="#">Deep Drop Down 4</a></li>
                      <li><a href="#">Deep Drop Down 5</a></li>
                    </ul>
                  </li>
                  <li><a href="#">Drop Down 2</a></li>
                  <li><a href="#">Drop Down 3</a></li>
                  <li><a href="#">Drop Down 4</a></li>
                </ul>
              </li>
              <li><a href="#contact">Contact</a></li>

            </ul>
          </nav><!-- .nav-menu -->

          <a href="#about" class="get-started-btn scrollto">Get Started</a>
        </div>
      </div>

    </div>
  </header><!-- End Header --> --}}
</body>

</html>
