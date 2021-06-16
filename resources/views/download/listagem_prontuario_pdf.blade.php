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
                <h1>Prontuário</h1> <!--De onde saiu a lista-->
            </div>
            <hr>
            <div class="container-listagem">
                <h2>Paciente</h2>
                <table> <!--Paciente-->
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Sexo</th>
                            <th>Tipo Sanguíneo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> <!--Cada Paciente-->
                            <td>Nome</td>
                            <td>CPF</td>
                            <td>Sexo</td>
                            <td>Tipo Sanguíneo</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h2>Dados sobre internação</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Data Internação</th>
                            <th>Data Saida</th>
                            <th>Leito</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Data Internação</td>
                            <td>Data Saida</td>
                            <td>Leito</td>
                            <td>Status</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h2>Agendamentos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Data</th>
                            <th>Medicamento</th>
                            <th>Posologia</th>
                            <th>Aplicador</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hora</td>
                            <td>Data</td>
                            <td>Medicamento</td>
                            <td>Posologia</td>
                            <td>Aplicador</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h2>Medicações ministradas</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Data</th>
                            <th>Medicamento</th>
                            <th>Posologia</th>
                            <th>Aplicador</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hora</td>
                            <td>Data</td>
                            <td>Medicamento</td>
                            <td>Posologia</td>
                            <td>Aplicador</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h2>Ocorrências</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Data</th>
                            <th>Responsável</th>
                            <th>Ocorrências</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Hora</td>
                            <td>Data</td>
                            <td>Responsável</td>
                            <td>Ocorrências</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h2>CIDs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>CIDs</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> <!--Criar outra <tr> para cada CIDs-->
                            <td>CIDs</td>
                            <td>Descrição</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </body>