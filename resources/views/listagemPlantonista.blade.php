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
    <section>
      <div class="container-1">
        <h1>LISTAGEM DE PLANTONISTA</h1>
        <div class="box">
          <div class="container-box">
            <div class="box-agendamento">
              <div class="row content-center">
                <div class="col-lg-6">
                  <h2>Nome</h2>
                </div>
                <div class="col-lg-6">
                  <h2>Cargo</h2>
                </div>
              </div>
              <hr>
              <div class="row content-center">
                <div class="col-lg-6">
                  <p>Nome do funcionário</p>
                </div>
                <div class="col-lg-6">
                  <p>Cargo do funcionário</p>
                </div>
              </div>
            </div>
            <h2 class="content-center">Escolha qual listagem gostaria de exibir</h2>
            <div class="content-center"> 
              <div class="row">
                <div class="col-lg-4">
                  <button type="button" class="btn-blue">Pacientes e Prontuários</button>
                </div>
                <div class="col-lg-4">
                  <button type="button" class="btn-blue">Responsáveis por aplicações</button>
                </div>
                <div class="col-lg-4">
                  <button type="button" class="btn-blue">Agendamentos</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>