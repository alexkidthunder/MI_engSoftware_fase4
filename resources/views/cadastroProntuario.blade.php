<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <title>Cadastro Prontuario</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <section> 

        <div class="container-1">
                <h1>CADASTRO DE PRONTUARIO</h1>
                <div class="box">
                    <!--Buscar paciente-->
                    <div class="content-center">
                        <h3>BUSCAR PACIENTE</h3>
                        <form class="search-bar">
                            <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required
                                maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!--Infomações do Paciente-->
                <h3>Paciente</h3><br>
                <div class="box-gray">
                    Marcos Oliveira Santana
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box-gray">
                            CPF: 011.988.999-00
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-gray">
                            CID: 0123456 BA
                        </div>
                    </div>
                </div>

                <br>
                <form id="register">
                    <div class="box-cadastroLeito">
                        <div class="row">
                            <div class="col-lg-4">
                                <div>
                                    <label name="Leito">Leito:</label>
                                    <input type="text" name="Leito Alocado" requerid>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label name="data_internacao">Data de Internação</label>
                                    <input type="date" name="data_internacao" requerid>
                                </div>
                            </div>
                        </div>
                        <div>
                        <button type="submit" class="btn-blue"> Cadastrar </button>
                        </div>
                    </div> 
                </form>           
        </div>      
    </section> 
 </body>
