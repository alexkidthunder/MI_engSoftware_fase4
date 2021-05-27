<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="{{ asset(' ') }}" rel="icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ 'js/historicoProntuario.js' }}" defer></script>

    <title>Historico de prontuários</title>

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

    <div class="container-1" id="historic">
        <h1 class="title-download">HISTÓRIO DE PRONTUÁRIOS </h1>

        <!------------- Busca do paciente ------------->
        <div id="search">
            <div class="box">
                <div class="content-center">
                    <h3>BUSCAR PACIENTE</h3>
                    <form class="search-bar">
                        <!--- Campo para a inserção do CPF do paciente --->
                        <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required maxlength="14"
                            pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!---------- Fim da Busca do paciente ---------->

        <!---------- Infomações do Paciente buscado ---------->
        <div class="row">
            <!------ Nome do Paciente ------>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                <div class="box-blue">
                    Ser o número 1 nisto ou na Ser o número 1 nisto ou n
                </div>
            </div>
            <!------ CPF do Paciente ------>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="box-blue">
                    CPF: 011.988.999-00
                </div>
            </div>
        </div>
        <!------ Fim das infomações do Paciente buscado ------>
        
        <br> 
        <!---------- Histórico de prontuários ---------->
        <div {{-- class="hide" --}} id="record">

            <!------------- Prontuário ------------->
            <div class="box-historic">
                <div class="row">
                    <!------ Data de internação ------>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                        <label>Data de Internação:</label> <br>
                        <div class="box-gray">
                            10/06/2020
                        </div>
                    </div>
                    <!------ Data de saída ------>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                        <label>Data de Saída:</label> <br>
                        <div class="box-gray">
                            25/06/2020
                        </div>
                    </div>
                    <!------ Motivo da saída ------>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <label>Motivo:</label> <br>
                        <div class="box-gray">
                            Em alta
                        </div>
                    </div>
                    <!------ Botão para acessar prontuário ------>
                    <div class="col-12 col-sm-6 col-md-12 col-lg-3 input-full-width">
                        <br>
                        <a href="{{ route('prontuario') }}" target="_parent"><button
                            class="btn-blue">Prontuário</button></a>
                    </div>
                </div>
            </div>
            <!------------- fim do prontuário ------------->

        <!---------- Fim de histórico de prontuários ---------->
    </div>
</body>

</html>
