<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    {{$i = 0}}
    <title>Lista de paciente</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->

    <!----------Botão de donwload------------>
    <div id="screen-icon">
        <form class="download-icon">
            <button>
                <i class="fas fa-download"></i>
            </button>
        </form>
    </div>
    <!--------Fim do botão de donwload-------->

    <div class="container-1" id="patientList">

        <h1 class="title-download">PACIENTES E PRONTUÁRIOS</h1>

        <!----------Seleção para o tipo de paciente que deseja exibir------------>
        <div class="content-center">
            <form>
                <select id="novaAtribuicao" name="novaAtribuicao" onchange="this.form.submit()">
                    <option value="internado" name="internado">Pacientes internados</option>
                    <option value="alta" name="alta">Pacientes de alta</option>
                    <option value="obito" name="obito">Pacientes em óbito</option>
                </select>
            </form>
        </div>

        <!--------------------- Paciente --------------------->
        @if(isset($p))
            @while(isset($p[$i]))
            <div class="box-white">
                <div class="row">
                    <!---------- Nome do paciente ------------>
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                        <div class="box-blue">
                        {{$p[$i]}}
                        </div>
                    </div>
                    <!----- Link para o prontuário do paciente ----->
                    <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                        <a href="{{ route('prontuario') }}" target="_parent"><button
                                class="btn-blue">Prontuário</button></a>
                    </div>
                    
                </div>
                {{$i++}}
            </div>
            @endwhile
        @endif
        <!--------------------- Fim do paciente --------------------->
    </div>
</body>

</html>
