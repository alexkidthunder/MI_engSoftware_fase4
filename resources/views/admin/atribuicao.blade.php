<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet"> 
    
    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ ('js/editarAtribuicao.js') }}" defer></script>

    <title>Atribuição do usuário</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->
    
    <h1>ALTERAR ATRIBUIÇÃO</h1>
        <div class="container-1">
            <div class="box">
                <!--Buscar funcionário-->
                <div class="content-center">
                    <h3>BUSCAR FUNCIONÁRIO</h3>
                    <form class="search-bar">
                        <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required maxlength="11" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit" id="busca_user">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div id="user_Data" style="display: none;">
                     <!--Infomações do funcionário funcionário-->
                    <h3>Funcionário</h3> <br>
                    <div class="box-gray">
                        <p>Marcos Oliveira Santana</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="box-gray">
                                <p>CPF: 011.988.999-00</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box-gray">
                                <p>COREN: 0123456 BA</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="box-gray">
                                <p id="atribuicaoAtual">Enfermeiro Chefe</p>
                            </div>
                        </div>
                    </div>

                    <!--Alterar atrinuição do funcionário funcionário, se for estagiário-->
                    <div class="container-atribution">
                        <label>Nova atribuição</label>
                            <form>
                                <select id="novaAtribuicao" name="novaAtribuicao">
                                    <option value="enfermeiroChefe">Enfermeiro chefe</option>
                                    <option value="enfermeiro">Enfermeiro</option>
                                </select>
                            </form>
                            <button type="submit" class="container-button btn-white">Alterar</button>
                    </div>
                </div>       
            </div>
        </div>
  </body>
