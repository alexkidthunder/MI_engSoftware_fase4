<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet"> 

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
    <title>Cadastro de Paciente</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    
    <h1>CADASTRO DE PACIENTE</h1>

    <!--ENFERMEIRO E ENFERMEIRO CHEFE -->
    
    <section>
        <div class="container-1">
            <div class="box">
                <form id="register">
                    <div class="row">
                        <div class="col-lg-9">
                            <label>Nome</label> <br>
                            <input id="fnome" name="fnome" type="text" maxlength="50" required>
                        </div>
                        <div class="col-lg-3">
                            <label>Tipo Sanguineo</label> <br>
                            <select id="fsanguineo" name="fsanguineo">
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
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

                    <div>
                        <button type="submit" class="btn-blue"> Cadastrar </button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</body>
