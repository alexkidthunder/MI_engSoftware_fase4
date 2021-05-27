<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <title>Log do sistema</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->

    <h1>LOG DO ADMINISTRADOR</h1>
    <section>
        <div class="box">
            <!---Botao de donwload ----->
            <form class="download-icon" align="right">
                <button>
                    <i class="fas fa-download"></i>
                </button>
            </form>
            <!--Tabela com os Logs do Sistema-->
            <table class="table table-striped">
                <thead>
                    <tr> <!--Header da Tabela-->
                        <th scope="col">Data/Hora</th>
                        <th scope="col">Ação</th>
                        <th scope="col">IP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr> <!--Inicio de um Log-->
                        <td>14/03/2021 - 15:03</td>
                        <td>Login no Sistema</td>
                        <td>142.245.371.224</td>
                    </tr> <!--Fim de um Log-->
                    <tr> <!--Inicio de um Log-->
                        <td>14/03/21 - 15:02</td>
                        <td>Visualizou Prontuários</td>
                        <td>120.762.301.102</td>
                    </tr> <!--Fim de um Log-->
                    <tr> <!--Inicio de um Log-->
                        <td>14/03/21 - 15:02</td>
                        <td>Visualizou Agendamentos</td>
                        <td>120.762.301.102</td>
                    </tr> <!--Fim de um Log-->
                    <tr> <!--Inicio de um Log-->
                        <td>13/03/21 - 12:30</td>
                        <td>Removeu Usuario João Vítor</td>
                        <td>182.271.211.654</td>
                    </tr> <!--Fim de um Log-->
                </tbody>
            </table>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>
</html>