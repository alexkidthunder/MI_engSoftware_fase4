<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="{{ asset(' ') }}" rel="icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ ('js/historicoProntuario.js') }}" defer></script>
    
    <title>Historico de Prontuário</title>
    
  </head>
  <body>
      <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <div id="screen-icon"> <!-- Icone de Download Em Telas -->
        <form class="download-icon">
            <button>
                <i class="fas fa-download"></i> <!--Baixar todos os prontuários de um paciente-->
            </button>
        </form>
    </div>
    <h1>Histórico de Prontuário</h1>
        <div class="container-1">
            <div class="box">
                <!--Buscar funcionário-->
                <div class="content-center">
                    <h3>BUSCAR PACIENTE</h3>
                    <form class="search-bar">
                        <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit" id="busca_user">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="hide" id="record">
                <!--Prontuários abaixo-->
                <div class="box-scheduling">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="box-gray">
                                Nome do Paciente
                            </div>
                        </div>     
                        <div class="col-lg-5">
                            <div class="box-gray">
                                Status do Prontuário <!--Em Aberto,Arquivado-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="box-gray">
                                Data de Internação
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="box-gray">
                                Data de Arquivamento
                            </div>
                        </div>
                        <div class="col-lg-2 input-full-width">
                            <button type="button" class="btn-blue">Prontuário</button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
</body>