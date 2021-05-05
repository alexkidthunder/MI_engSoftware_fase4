

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
    <title>Lista de paciente</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
        <div id="tela-icone"> <!-- Icone de Download Em Telas -->
            <form class="download-icone">
                <button>
                    <i class="fas fa-download"></i>
                </button>
            </form>
        </div>

        <div class="container-1" id="patientList">
            <!--ENFERMEIRO, ENFERMEIRO CHEFE E ESTAGIARIO -->
<!---Botao de donwload ----->
            <h1>PACIENTES E PRONTUÁRIOS</h1>
            <div class="content-center">
                <form>
                    <select id="novaAtribuicao" name="novaAtribuicao">
                        <option value="internado">Pacientes internados</option>
                        <option value="alta">Pacientes de alta</option>
                        <option value="obito">Pacientes em óbito</option>
                    </select>
                </form>
            </div>

            <div class="box-white">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="box-blue">
                                Paciente Fulano de Tal
                             </div>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn-blue">Prontuário</button>
                        </div>
                    </div>
            </div>
            
            <!--APAGAR DEPOIS -->
            <div class="box-white">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="box-blue">
                                Paciente Fulano de Tal
                             </div>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn-blue">Prontuário</button>
                        </div>
                    </div>
            </div>

        </div>
  </body>
