<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('img/favicon.png') }}" rel="icon">
        <title>PDF_Download</title>
        <link href="{{ 'css/download-style.css' }}" rel="stylesheet">
        <link href="/public/css/download-style.css" rel="stylesheet">
        
    </head>
    <body>
        <header class="container-personal-data">
            <div>
                <h2>Nome Hospital</h2> <!--Nome do nosso Hospital-->
            </div>
            <div>
                <h2>Nome / CPF</h2> <!--Nome e CPF de quem requisitou o download-->
            </div>
            <div>
                <h2>00:00 - 00/00/00</h2> <!--Data e Hora em que foi feito o download-->
            </div>
        </header>
        <hr>
        <section>
            <div class="container-header"> 
                <h1>Pacientes e Prontuários</h1> <!--De onde saiu a lista-->
            </div>
            <hr>
            <div class="container-listagem">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> <!--Cada Pessoa-->
                            <td>Maria</td>
                            <td>Internada</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <footer style="position: absolute; bottom: 0;">
            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
        </footer>
    </body>