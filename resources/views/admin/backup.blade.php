<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
    <script src="{{ ('js/backup.js') }}" defer></script>

    <title>BACKUP</title>
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->
    
    <h1>Backup do Sistema</h1>
    <section>
        <div class="container-1">
            <div class="box"> <!--Caixa onde as opções se encontram-->
                <div class="row item-center">
                    <div class="col-lg">
                        <!--Botão onde, quando clicado, o backup deve ser feito na hora-->
                        <input class="btn-white" type="button" name="realBack" id="realBack" value="Realizar Backup">
                    </div>
                    <div class="col-lg">
                        <!--Botão onde, quando clicado, o backup deve ser agendado-->
                        <input class="btn-white" type="button" name="agenback" id="agenBack" value="Agendar Backup">
                    </div>
                </div>
                <!--Area onde o agendamento do backup é feita-->
                <div class="hide" id="AgendamentoBackup">
                    <div class="row">
                        <div class="box-backup item-center">
                            <h4>Agendamento de Backup</h4>
                            <form>
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <!--Botão para marcar caso o agendamento seja de um backup automático-->
                                        <label for="alwaysCheck">Automático</label> <br>
                                        <input type="checkbox" name="alwaysCheck" id="alwaysCheck" checked>
                                    </div>
                                    <div class="col-lg-4">
                                        <!--Horario em que o backup será feito-->
                                        <label for="fhorario">Horario</label><br>
                                        <input name="fhorario" type="time" id="fhorario" required>
                                    </div>
                                    <div class="col-lg-4 hide" id="dataDiv">
                                        <!--Data em que o backup será feito. Se for um backup automático, está parte não aparece-->
                                        <label for="date">Data</label> <br>
                                        <input type="date" name="date" id="date">
                                    </div>
                                </div>
                                <div class="row">
                                    <!--Botão para confirmar o agendamento de um backup-->
                                    <input class="container-button btn-white"type="submit" value="Confirmar" id="confirmarBackup">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>    
            </div>
        </div>      
        <div class="container-1">
        <!--Area onde de encontra os backups que já foram agendados-->
            <div class="box" id="ListaBackup">
                <h3>Backups Agendados</h3>
                <!--Tabela com os backups-->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr> <!--Header da tabela--> 
                                <th scope="col">Automático</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Data</th>
                                <th scope="col">IP</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <!--Backup-->
                            <tr id="codigoDoBackup">
                                <td>Não</td>
                                <td>09:40</td>
                                <td>24/04/2021</td>
                                <td>192.222.123.128</td>
                                <td><input class="btn-blue" type="button" id="removeBackup-codigoDoBackup" value="Remover"></td>
                            </tr> 
                            <!--Fim de um Backup-->
                            <!--Backup-->
                            <tr id="codigoDoBackup2">
                                <td>Sim</td>
                                <td>12:00</td>
                                <td>--</td>
                                <td>192.222.123.128</td>
                                <td><input class="btn-blue" type="button" id="removeBackup-codigoDoBackup2" value="Remover"></td>
                            </tr>
                            <!--Fim de um Backup-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>