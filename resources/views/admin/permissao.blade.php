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
    <header class="header-adm">
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
                 <h3>Funcionário</h3>
                <div class="container-box">
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
            </div>
            <div class="box">
                <div class="container-box">
                    <h3 class="content-center">PERMISSÕES</h3>
                    <div class="row">
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Cadastrar Paciente</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Cadastrar Agendamento</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Cadastrar Plantonista</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Cadastrar Medicamentos</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--A cada 4 permissões, utilizar uma nova div de classe row-->
                    </div>
                    <div class="row">
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Listagem de Pacientes</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Listagem de Agendamentos</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Visualizar Prontuário</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Visualizar Plantonista</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--A cada 4 permissões, utilizar uma nova div de classe row-->
                    </div>
                    <div class="row">
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Adicionar Ocorrência</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Visualizar Ocorrência</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Baixa Agendamentos</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--Inicio de uma permissão-->
                        <div class="col-lg-3 content-center">
                            <label>Cadastrar CIDs</label> <br>
                            <input type="checkbox" class="checkmark">
                        </div>
                        <!--Fim de uma permissão-->
                        <!--A cada 4 permissões, utilizar uma nova div de classe row-->
                    </div>
                    <div>
                        <button type="submit" class="container-button btn-white">Alterar</button>
                    </div>
                </div>
            </div>
        </div>
  </body>
