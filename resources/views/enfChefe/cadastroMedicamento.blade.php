<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
    
    <title>Cadastro de Medicamentos</title>
</head>

<body>
    <header class="header-adm">
        <img src="../icons/svg/admin-with-cogwheels.svg" alt="Logo" class="options-img" />
        <a href="/">Nome Funcionário</a>
        <nav>
            <ul class="header-menu">
                <li><a href="/">INICIO</a></li>
                <li><a href="/">CADASTRAR PACIENTE</a></li>
                <li><a href="/">CADASTRAR PLANTONISTA</a></li>
                <li><a href="/">CADASTRAR AGENDAMENTOS</a></li>
                <li><a href="/">CADASTRAR MEDICAMENTOS</a></li>
                <li><a href="/">PACIENTES E PRONTUARIO</a></li> 
            </ul>
        </nav>
    </header>
    <h1>CADASTRO DE MEDICAMENTOS</h1>
    <section>
        <div class="container-1">
            <div class="box">
                <form id="register">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Nome</label> <br>
                            <input id="fnome" name="fnome" type="text" maxlength="50" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Fabricante</label> <br>
                            <input id="ffabricante" name="ffabricante" type="text" maxlength="50" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <label>Data de Validade</label> <br>
                            <input id="fnascimento" name="fnascimento" type="date" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Quantidade</label> <br>
                            <input id="fquantidade" name="fquantidade" type="text" required maxlength="40" required>
                        </div>
                    </div>

                    <div>
                        <button class="btn-blue"> Cadastrar </button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</body>
