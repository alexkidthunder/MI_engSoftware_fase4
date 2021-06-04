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
    <header id="header">

        <!-------- Nome do funcionário e acesso ao perfil -------->
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex ml-3">
                <a href="{{ route('editarPerfil') }} " class="user"> <i class="fas fa-user"></i></a>
                <div class="col-lg-3">
                     @if(isset($_SESSION['administrador']))
                    <h2><a href="{{ route('editarPerfil') }}">{{$_SESSION['administrador']}}</a></h2>
                    @endif
                    @if(isset($_SESSION['enfermeiroChefe']))
                    <h2><a href="{{ route('editarPerfil') }}">{{$_SESSION['enfermeiroChefe']}}</a></h2>
                    @endif
                    @if(isset($_SESSION['enfermeiro']))
                    <h2><a href="{{ route('editarPerfil') }}">{{$_SESSION['enfermeiro']}}</a></h2>
                    @endif
                    @if(isset($_SESSION['estagiario']))
                    <h2><a href="{{ route('editarPerfil') }}">{{$_SESSION['estagiario']}}</a></h2>
                    @endif
                    
                </div>
            </div>

            <!-------- Botão de logout -------->
            <div class="d-flex align-items-center pr-5">
                <nav class="nav d-lg-block">
                    <li><a href="/logout" class="logout-icon"> <i class="fas fa-sign-out-alt"></i></a>
                    </li>
                    </ul>
                </nav>

            </div>
        </div>
    </header>
</body>

</html>
