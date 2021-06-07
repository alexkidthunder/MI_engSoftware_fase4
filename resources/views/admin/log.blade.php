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
            <div class="table-responsive scrolls">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr> <!--Header da Tabela-->
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
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>
</html>