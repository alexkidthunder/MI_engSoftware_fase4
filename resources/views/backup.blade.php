<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">

    <title>Backup</title>
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
    <h1>Backup do Sistema</h1>
    <section>
        <div class="box-auto">
            <input class="row order-0" type="button" value="Realizar Backup">
            <input class="row order-1" type="button" value="Agendar Backup">
        </div>
        <div class="box-auto">
            <h2>Agendamento Backup</h2>
            <div >
                <div>
                    <label for="fhorario">Horario</label><br>
                    <input name="fhorario" type="datetime-local">
                    <input type="button" value="Confirmar">
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>