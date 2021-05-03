<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <title>Cadastro de funcionários</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->

    <h1>CADASTRO DE FUNCIONÁRIO</h1>
    <section>
        <div class="container-1">
            <div class="box">
                <form id="register" action="{{ route('salvarUsuario') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Nome</label> <br>
                            <input id="fnome" name="fnome" type="text" maxlength="50" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <label>Data de Nascimento</label> <br>
                            <input id="fnascimento" name="fnascimento" type="date" required>
                        </div>
                        <div class="col-lg-4">
                            <label>CPF</label> <br>
                            <input id="fcpf" name="fcpf" type="text" required maxlength="14"
                                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        </div>
                        <div class="col-lg-4">
                            <label>Sexo</label> <br>
                            <div class="row no-gutters">
                                <div class="col-lg border-m content-center">
                                    <input type="radio" name="fsexo" value="Masculino" id="fmasc">Masculino</input>
                                </div>
                                <div class="col-lg border-f content-center">
                                    <input type="radio" name="fsexo" value="Feminino" id="ffem">Feminino</input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <label>Email</label> <br>
                            <input id="femail" name="femail" type="email" maxlength="50" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Atribuição</label> <br>
                            <select id="fatribui" name="fatribui">
                                <option value="Administrador">Administrador</option>
                                <option value="Enfermeiro Chefe">Enfermeiro Chefe</option>
                                <option value="Enfermeiro">Enfermeiro</option>
                                <option value="Estagiário">Estagiário</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-blue"> Cadastrar </button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</body>
