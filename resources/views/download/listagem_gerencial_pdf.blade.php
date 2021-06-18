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
                <h1>Relatório Gerencial</h1> <!--De onde saiu a lista-->
            </div>
            <hr>
            <div class="container-listagem">
                <table>
                    <thead>
                        <tr>
                            <th>Pacientes Internados</th>
                            <th>Funcionários Cadastrados</th>
                            <th>CID mais frequente</th>
                            <th>Taxa de óbito</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> 
                            <td>Pacientes Internados</td> <!--Pacientes Internados-->
                            <td>Funcionários Cadastrados</td> <!--Funcionários Cadastrados-->
                            <td>CID mais frequente</td> <!--CID mais frequente-->
                            <td>Taxa de óbito</td> <!--Taxa de óbito-->
                        </tr>
                        <tr>
                            <th>Idade Media entre Pacientes</th>
                            <th>Medicamento mais usado</th>
                            <th>Quantidade de Leitos Cadastrados</th>
                            <th>Quantidade de Leitos Ocupados</th>
                        </tr>
                        <tr> 
                            <td>Idade Media entre Pacientes</td> <!--Idade Media entre Pacientes-->
                            <td>Medicamento mais usado</td> <!--Medicamento mais usado-->
                            <td>Quantidade de Leitos Cadastrados</td> <!--Quantidade de Leitos Cadastrados-->
                            <td>Quantidade de Leitos Ocupados</td> <!--Quantidade de Leitos Ocupados-->
                        </tr>
                        <tr>
                            <th>Enfermeiros Chefes Ativos</th>
                            <th>Enfermeiros Ativos</th>
                            <th>Estagiários Ativos</th>
                            <th>Administradores Cadastrados</th>
                        </tr>
                        <tr> 
                            <td>Enfermeiros Chefes Ativos</td> <!--Enfermeiros Chefes Ativos-->
                            <td>Enfermeiros Ativos</td> <!--Enfermeiros Ativos-->
                            <td>Estagiários Ativos</td> <!--Estagiários Ativos-->
                            <td>Administradores Cadastrados</td> <!--Administradores Cadastrados-->
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <footer style="position: absolute; bottom: 0;">
            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
        </footer>
    </body>