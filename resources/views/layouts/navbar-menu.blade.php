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
        <a href="{{ route('editarPerfil') }} " class="user"><img src="{{asset(' ')}}" class="img-fluid"></a>
        <div class="col-lg-3">
          <h2><a href="{{ route('editarPerfil') }}">NOME FUNCIONÁRIO</a></h2>
        </div>
      </div>
    
      <div class="d-flex align-items-center pr-5">    
        <nav class="nav d-none d-lg-block">
            <li><a href="#"><img src="{{asset(' ')}}" class="img-fluid"></a></li>
          </ul>
        </nav>
        
      </div>
    </div>
  </header>
</body>
</html>