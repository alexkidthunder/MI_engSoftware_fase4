<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <title>Cadastro de funcionários</title>
</head>

<body>
    <header class="header-adm">
        <img src="../icons/svg/admin-with-cogwheels.svg" alt="Logo" class="options-img" />
        <a href="/">Nome Funcionário</a>
        <nav>
            <ul class="header-menu">
                <li><a href="/">INICIO</a></li>
                <li><a href="/">FUNCIONÁRIOS</a></li>
                <li><a href="/">LOG DO SISTEMA</a></li>
                <li><a href="/">ALTERAÇÕES</a></li>
                <li><a href="/">BACKUP</a></li>
            </ul>
        </nav>
    </header>

    @if(Session::has('error'))
    <div class="alert alert-danger mt-5" role="alert">
            {{Session::get('error')}}
    </div>
    @endif

    <h1>CADASTRO DE FUNCIONÁRIO</h1>
    <section>
        <div class="container-1">
            <div class="box">
                <form id="register" action="{{route('salvarUsuario')}}" method="POST">
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
                            <input id="fcpf" name="fcpf" type="text" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        </div>
                        <div class="col-lg-4">
                            <div class="sex-form">
                                <label>Sexo</label> <br>
                                <div class="row no-gutters">
                                    <div class="col-lg sex-border content-center">
                                        <label for="fmasc">Masculino</label>
                                        <input class="sex-input" type ="radio" name="fsexo" value = "Masculino" id="fmasc"></input>
                                    </div>
                                    <div class="col-lg sex-border content-center">
                                        <label for="ffem">Feminino</label>
                                        <input class="sex-input" type ="radio" name="fsexo" value = "Feminino" id="ffem"></input>
                                    </div>
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
                        <button type = "submit" class="btn-blue"> Cadastrar </button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</body>
