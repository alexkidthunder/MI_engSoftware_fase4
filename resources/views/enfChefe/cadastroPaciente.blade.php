<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('public/css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('public/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <title>Cadastro de Paciente</title>
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
    <h1>CADASTRO DE PACIENTE</h1>
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
                                <input id="MASCULINO" name="fsexo" value="Masculino" type="button">
                                <input id="FEMININO" name="fsexo" value="Feminino" type="button">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <label>Tipo Sanguineo</label> <br>
                            <input id="fsanguineo" name="fsanguineo" type="text" maxlength="50" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Data de Internação</label> <br>
                            <input id="fdatainternacao" name="fdatainternacao" type="date" required>
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
