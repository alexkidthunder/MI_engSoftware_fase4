<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ ('css/navbar-style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
  <header  class="header" id="header" class="fixed-top">
    
    <div class="d-flex align-items-center justify-content-between">
      <div class="d-flex">
        <a href="{{ route('editarPerfil') }}" class="user"><img src="{{asset(' ')}}" class="img-fluid"></a>
        <div>
          <h2><a href="{{ route('editarPerfil') }}">OLÁ, NOME FUNCIONÁRIO</a></h2>
        </div>
      </div>
    
      <div class="d-flex align-items-center pr-5">    
        <nav class="nav d-none d-lg-block">

          <ul>
            <li class="title-nav"><a href="{{ route('menu') }}">INÍCIO</a></li>
            <li class="drop-down title-nav"><a>FUNCIONÁRIOS</a>
                <ul>
                    <li><a href="{{ route('cadastrarUsuario') }}">Cadastrar</a></li>
                    <li><a href="{{ route('removerUsuario') }}">Remover</a></li>
                    <li><a href="{{ route('editarAtribuicao') }}">Alterar atribuição</a></li>
                    <li><a href="{{ route('editarPermissao') }}">Alterar permissões</a></li>
                </ul>
            </li>
     
            <li class="title-nav"><a href="{{ route('log') }}">LOG DO SISTEMA</a></li>
         
            <li class="title-nav"><a href="{{ route('backup') }}">BACKUP</a></li>
         
            <li><a href="#"><img src="{{asset(' ')}}" class="img-fluid"></a></li>
         
          </ul>
        </nav>
      </div>
    </div>
  </header>
</body>
</html>