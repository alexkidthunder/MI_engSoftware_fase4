<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet"> 
    <title>Atribuição do usuário</title>
    
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
        <h1>PLANTONISTAS</h1>
            <div class="box-agendamento">
              <!-- Alterar Estado Plantão -->
                <div class="container-box">
                  <!-- Cabeçalho do "Alterar Plantão" -->
                  <div class="row">
                    <div class="col-lg-4">
                      <div>
                        <h2>NOME</h2>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div>
                        <h2>CARGO</h2>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div>
                        <h2>DISPONIBILIDADE</h2>
                      </div>
                    </div>
                  </div>
                  <!-- Fim do Cabeçalho do "Alterar Plantão" -->
                  <!-- Começo do Corpo do Alterar Plantão -->
                  <div class="row">
                    <div class="col-lg-4">
                      <div>
                        <h2 class="box-blue">NOME</h2>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div>
                        <h2 class="box-blue">CARGO</h2>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div>
                        <input class="checkmark container-button-plantonista" type="checkbox">
                      </div>
                    </div>
                  </div>
                  <!-- Fim do corpo do Alterar Plantonista -->
                </div>
            </div>
        </div>
    </section>
    

  </body>