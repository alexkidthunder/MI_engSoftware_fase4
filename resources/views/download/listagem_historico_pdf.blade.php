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
                <h3>Hospital Universitário da UEFS</h3> <!--Nome do Hospital-->
            </div>
            <div>
                <h3>Nome / CPF</h3> <!--Nome e CPF de quem requisitou o download-->
            </div>
            <div>
                <h3>00:00 - 00/00/00</h3> <!--Data e Hora em que foi feito o download-->
            </div>
        </header>
        <hr>
        <section>
            <div class="container-header"> 
                <h1>Historico de Prontuário</h1> <!--De onde saiu a lista-->
            </div>
            <hr>
            <div>
                <p><span>Nome Paciente</span> - <span>CPF Paciente</span></p>
            </div>
            <div class="container-listagem">
                <table>
                    <thead>
                        <tr>
                            <th>#</th> <!--Numero do Prontuário-->
                            <th>Data de Internação</th>
                            <th>Data de Saída</th>
                            <th>Motivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> <!--Cada Prontuário-->
                            <td>Número do Prontuário</td> <!--Numero do Prontuário-->
                            <td>Data de Internação</td> <!--Data de Internação-->
                            <td>Data de Saída</td> <!--Data de Saída-->
                            <td>Motivo</td> <!--Motivo-->
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <footer style="position: absolute; bottom: 0;">
            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
        </footer>
    </body>