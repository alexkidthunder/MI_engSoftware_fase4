<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <title>Permissões do usuário</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->

    <h1>ALTERAR PERMISSÕES</h1>
        <div class="container-1">
            <div class="box">
                <!--Buscar funcionário-->
                <div class="content-center">
                    <h3>BUSCAR FUNCIONÁRIO</h3>
                    <form class="search-bar">
                        <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required maxlength="11" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                 <!--Infomações do funcionário funcionário-->
                 <h3>Funcionário</h3> <br>
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
                                COREN: 0123456 BA
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box-gray">
                                Enfermeiro chefe
                            </div>
                        </div>
                    </div>
            </div>

            <!---------------- Alterar permissões ---------------->
            <div class="box" id="permission">
                    <h3 class="content-center">PERMISSÕES</h3> <br>
                    <div class="row">
                        <!--Inicio da permissão-->
                        <div class="col-lg-3 content-center">
                            <input type="checkbox"><br>
                            <label>Cadastrar Paciente</label>
                        </div>
                        <!--Fim da permissão-->
                    </div>
                    
                    <div>
                        <button type="submit" class="container-button btn-white">Alterar</button>
                    </div>  
            </div>
        </div>
  </body>
