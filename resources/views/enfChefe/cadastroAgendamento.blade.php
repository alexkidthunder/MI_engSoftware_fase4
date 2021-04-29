<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <title>Cadastro Agendamento</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <section>
        <div class="container-1">
          <h1>CADASTRO DE AGENDAMENTO</h1>
            <div class="box">
                <!--Buscar paciente-->
                <div class="content-center">
                    <h3>BUSCAR PACIENTE</h3>
                    <form class="search-bar">
                        <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required maxlength="11" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                 <!--Infomações do Paciente-->
                 <h3>Paciente</h3>
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
                        <div class="col-lg-4">
                            <div class="box-gray">
                                Leito: XXX
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cadastro do medicamento -->
                    <div class="box-agendamento">
                        <form id="register">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div>
                                            <label name="horario_agendamento">Horario</label> <br>
                                            <input type="time" name="horario_agendamento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <label name="data_agendamento">Data</label> <br>
                                            <input type="date" name="data_agendamento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <label name="posologia_agendamento">Posologia</label> <br>
                                            <input type="number" name="posologia_agendamento" placeholder="Colocar em ml">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <label name="medicamento_agendamento">Medicamento</label> <br>
                                            <input type="text" name="medicamento_agendamento" placeholder="Ex: Dipirona">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div>
                                            <label name="aplicador_agendamento">Aplicador</label> <br>
                                            <input type="text" name="aplicador_agendamento" placeholder="Nome do Aplicador (pode estar vazio)">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <br> <!-- Alinhar -->
                                            <input class="btn-white" type="button" value="Alocar Aplicador">
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div>
                        <button type="submit" class="container-button btn-white">Cadastrar Agendamento</button>
                    </div>
                
            </div>
        </div>
    </section>
  </body>