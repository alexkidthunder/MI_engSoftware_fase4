<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <title>CADASTRO DE FUNCIONÁRIO</title>
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
      <h1>Cadastro de Funcionários</h1>
      <section>
          <form>
            <div class="container-1 box form-layout">
                <div class="nome-form">
                    <label for="fnome">Nome</label> <br>
                    <input id="fnome" name="fnome" type="text" maxlength="50">
                </div>
                <div>
                    <label for="fnascimento">Data de Nascimento</label> <br>
                    <input id="fnascimento" name="fnascimento" type="date">
                </div>
                <div>
                    <label for="fcpf">CPF</label> <br>
                    <input id="fcpf" name="fcpf" type="text" maxlength="14">
                </div>
                <div class="sex-form">
                    <label for="fsexo">Sexo</label> <br>
                    <input id="MASCULINO" name="fsexo" value="Masculino" type="button">
                    <input id="FEMININO" name="fsexo" value="Feminino" type="button">
                </div>
                <div class="email-form">
                    <label for="femail">Email</label> <br>
                    <input id="femail" name="femail" type="email" maxlength="50">
                </div>
                <div>
                    <label for="fatribui">Atribuição</label> <br>
                    <select id="fatribui" name="fatribui">
                        <option value="Administrador">Administrador</option>
                        <option value="Enfermeiro Chefe">Enfermeiro Chefe</option>
                        <option value="Enfermeiro">Enfermeiro</option>
                        <option value="Estagiário">Estagiário</option>
                    </select>
                </div>
                <div class="submit-adm">
                    <input class="sbm-btn" type="submit" value="Cadastrar"> 
                </div>
            </div>
          </form>
      </section>
  </body>