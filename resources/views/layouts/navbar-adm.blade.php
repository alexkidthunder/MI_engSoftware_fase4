<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/navbar-style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
  <header  class="header" id="header" class="fixed-top">
    
    <div class="d-flex align-items-center justify-content-between">
      <div class="d-flex">
        <a href="{{ route('editarPerfil') }} " class="user"> <i class="fas fa-user"></i></a>
        <div class="col-lg-3">
          <h2><a href="{{ route('editarPerfil') }}">NOME FUNCIONÁRIO</a></h2>
        </div>
      </div>
    
      <div class="d-flex align-items-center pr-5">    
        <nav class="nav d-none d-lg-block">

          <ul>
            <li class="title-nav"><a href="{{ route('menu') }}">INÍCIO</a></li>
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
         
            <li><a href="#"class="logout-icon"> <i class="fas fa-sign-out-alt"></i></a></li>
         
          </ul>
        </nav>
      </div>
    </div>
  </header>
</body>
</html>