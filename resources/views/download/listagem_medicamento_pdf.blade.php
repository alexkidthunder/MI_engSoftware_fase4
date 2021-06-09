<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('img/favicon.png') }}" rel="icon">
        <title>PDF_Download</title>
        <link href="{{ 'css/download-style.css' }}" rel="stylesheet">
        
    </head>
    <body>
        <header class="container-personal-data">
            <div>
                <h3>Nome Hospital</h3> <!--Nome do nosso Hospital-->
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
                <h1>Medicamentos</h1> <!--De onde saiu a lista-->
            </div>
            <hr>
            <div class="container-listagem">
                <table>
                    <thead>
                        <tr>
                            <th>Nome Medicamento</th>
                            <th>Nome do Fabricante</th>
                            <th>Data de Validade</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> <!--Cada Medicamento-->
                            <td>Nome</td>
                            <td>Nome do Fabricante</td>
                            <td>xx/xx/xx</td>
                            <td>100</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <footer style="position: absolute; bottom: 0;">
            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
        </footer>
    </body>