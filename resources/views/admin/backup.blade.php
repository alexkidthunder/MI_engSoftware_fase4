<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
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
            <div class="box">
                <div class="row item-center">
                    <div class="col-lg">
                        <input class="btn-white" type="button" name="realBack" id="realBack" value="Realizar Backup">
                    </div>
                    <div class="col-lg">
                        <input class="btn-white" type="button" name="agenback" id="agenBack" value="Agendar Backup">
                    </div>
                </div>
                <div class="row hide" id="AgendamentoBackup" style="display: none;">
                    <div class="box-agendamento item-center">
                        <h4>Agendamento de Backup</h4>
                        <div class="row">
                            <div class="col-lg">
                                <label for="fhorario">Horario</label><br>
                                <input name="fhorario" type="time" id="fhorario">
                            </div>
                            <div class="col-lg">
                                <label for="alwaysCheck">Sempre?</label> <br>
                                <input class="checkmark" type="checkbox" name="alwaysCheck" id="alwaysCheck" checked>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg" id="dataDiv" style="display: none;">
                                <label class="label-no-margin" for="date">Data</label> <br>
                                <input type="date" name="date" id="date">
                            </div>
                            <div class="col-lg">
                                <label></label> <br>
                                <input class="btn-white"type="button" value="Confirmar" id="confirmarBackup">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
        <div class="container-1">
            <div class="box" id="ListaBackup">
                <h4>Backups Agendados</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sempre?</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Data</th>
                            <th scope="col">IP</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="codigoDoBackup">
                            <td>Não</td>
                            <td>09:40</td>
                            <td>24/04/2021</td>
                            <td>192.222.123.128</td>
                            <td><input class="btn-blue" type="button" id="removeBackup-codigoDoBackup" value="Remover"></td>
                        </tr>
                        <tr id="codigoDoBackup2">
                            <td>Sim</td>
                            <td>12:00</td>
                            <td>--</td>
                            <td>192.222.123.128</td>
                            <td><input class="btn-blue" type="button" id="removeBackup-codigoDoBackup2" value="Remover"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>