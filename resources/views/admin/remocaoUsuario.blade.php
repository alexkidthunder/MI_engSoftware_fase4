<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet">
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <title>Remoção de funcionário</title>  
  </head>
  
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->

    <h1>REMOÇÃO DE FUNCIONÁRIOS</h1>
    <div class="container-1">
        <div class="box">
            <!--Buscar funcionário-->
            <div class="content-center">
                <h3>BUSCAR FUNCIONÁRIO</h3>
                <form class="search-bar" action="/buscarUsuario" method="GET">
                    <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!--Infomações do funcionário funcionário-->
            @if(isset($user))
            <h3>Funcionário</h3>

            <div class="container-box">
                <div class="box-gray">
                    NOME: {{$user->Nome}}
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box-gray">
                            CPF: {{$user->CPF}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-gray">
                            COREN:
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-gray">
                            {{$user->Atribuicao}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-box">
                <a href= '/removerUsuario? usuario={{$user->CPF}}' onclick=" return confirm('Tem certeza que deseja apagar o usuario?') "> <button class="container-button btn-blue "> Remover </button> </a>
            </div>
            @endif
        </div>
    </div>
</body>
