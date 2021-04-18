

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
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
    <h1>ALTERAR ATRIBUIÇÃO</h1>
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

                 <!--Alterar atrinuição do funcionário funcionário, se for estagiário-->
                 <div class="container-atribution">
                    <label>Nova atribuição</label>
                    <form>
                        <select id="novaAtribuicao" name="novaAtribuicao">
                            <option value="enfermeiroChefe">Enfermeiro chefe</option>
                            <option value="enfermeiro">Enfermeiro</option>
                        </select>
                    </form>
                    <button type="submit" class="container-button btn-white">Alterar</button>
                </div>

                 <!--Alterar atrinuição do funcionário funcionário, se for enfermeiro
                 <div class="container-atribution">
                    <label>Nova atribuição</label>
                    <form>
                        <select id="novaAtribuicao" name="novaAtribuicao">
                            <option value="enfermeiroChefe">Enfermeiro chefe</option>
                        </select>
                    </form>
                    <button type="submit" class="container-button btn-white">Alterar</button>
                </div>

                <!--Alterar atrinuição do funcionário funcionário, se for enfermeiro chefe
                <div class="container-atribution">
                    <label>Nova atribuição</label>
                    <form>
                        <select id="novaAtribuicao" name="novaAtribuicao">
                            <option value="Enfermeiro Chefe">Enfermeiro</option>
                        </select>
                    </form>
                    <button type="submit" class="container-button btn-white">Alterar</button>
                </div> -->

              
            </div>
        </div>
  </body>
