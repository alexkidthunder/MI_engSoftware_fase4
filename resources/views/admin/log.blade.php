<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ ('js/log.js') }}" defer></script>

    <title>Log do sistema</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->

    <!---------------Notificação para o usuário-------------->
    @if(isset($_SESSION['notifi']))
    @if(!empty ($_SESSION['notifi']))
    <div id="notification">
        <div class='msg-notification'>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12 col-sm-12">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="col-lg-8 col-md-8 col-10 col-sm-10">
                    {{$_SESSION['notifi']}} 
                </div>
                <form action="/apagarN" method="get">
                    <div class="col-lg-2 col-md-2 col-2 col-sm-2">
                        <button name="fechar" type="submit" class="btn-close" id="close"><i class="fas fa-times"></i></button>
                    </div>
                </form>
            </div>
        </div>
    <div>
    @endif
    @endif
    <!---------------Fim de notificação-------------->

    <h1>LOG DO ADMINISTRADOR</h1>
    <section>
        <div class="box">
            <label id="pagina_label" style="display:flex; float: left;">Pagina </label>
            <!---Botao de donwload ----->
            <form method="get" action="/baixarArquivos" class="download-icon" align="right">
                <button>
                    <i class="fas fa-download"></i>
                </button>
                <input type="hidden" name="tela" value="log">
            </form>
            
            <!--Escolher o numero de Logs por pagina-->
            <div>
                <label for="n_log">Numero de Logs</label>
                <select name="n_log" id="n_log">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="250">250</option>
                    <option value="500">500</option>
                </select>
            </div>
            <div style="display:flex; float:left;">
                <a id="show_size">Temos x Logs</a>
            </div>
            <div id="log_controller" name="log_controller" style="display:flex; float:right;">
                <ul class="horizontal-list" id="list-page">
                </ul>
            </div>
            <!--Tabela com os Logs do Sistema-->
            <div class="table-responsive scrolls">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr> <!--Header da Tabela-->
                            <th scope="CPF">Data</th>
                            <th scope="col">Data</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Ação</th>
                            <th scope="col">IP</th>
                        </tr>
                    </thead>
                    <tbody id="Log_table">
                        @if(isset($logs))
    
                            @foreach (array_reverse($logs) as $value)
                                <tr>
                                    <td> {{ $value['CPF'] }} </td>
                                    <td> {{ $value['Data_Log'] }} </td>
                                    <td> {{ $value['Hora_Agend'] }} </td>
                                    <td> {{ $value['Acao']}} </td>
                                    <td> {{ $value['Ip']}} </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>    
        </div>
        <input type="hidden" id="tamanho_log" value={{count($logs)}}>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>
</html>