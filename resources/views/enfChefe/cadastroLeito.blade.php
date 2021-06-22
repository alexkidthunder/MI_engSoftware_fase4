<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <title>Cadastro de Leito</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
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

    <section>
        <div class="container-1">
            <h1>CADASTRO DE LEITO</h1>

            <!---------------------Mensagens do sistema--------------------->
            @if (session('msg-sucess'))
                <!-- Verifica se a mensagem de erro foi instanciada -->
                <div class="msg-sucess">
                    {{ session('msg-sucess') }}
                    <!--Obtem mensagem de erro -->
                </div>
            @endif

            @if (session('msg-error'))
                <!-- Verifica se a mensagem de erro foi instanciada -->
                <div class="msg-error">
                    {{ session('msg-error') }}
                    <!--Obtem mensagem de erro -->
                </div>
            @endif
            <!---------------------fim de Mensagens do sistema--------------------->

            <div class="box">
                <br>
                <!---------------------Inicio de cadastro de um novo leito--------------------->
                <form id="register" method="get" action="/cadastrarLeito">
                    <div class="box-cadastroLeito">
                        <div class="row">
                            <div class="col-lg-6">
                                <div>
                                    <label name="Leito">Leito:</label>
                                    <input type="text" name="Leito" maxlength="10" required>
                                </div>
                                <button type="submit" class="btn-blue"> Cadastrar </button>
                            </div>
                        </div>
                </form>

                <!---------------------Fim de cadastro de leitos--------------------->
                <div class="box-scheduling" , id="container-teste4">
                    <form id="register">
                        <div class="row">
                            <!--------Inicio da Tabela com todos os leitos cadastrados-------->
                            <h3>Tabela de Leitos</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Leito</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (isset($leitos))
                                        <?php foreach ($leitos as $value) { ?>
                                        <tr>
                                            <td> {{ $value['Identificacao'] }} </td>
                                            <td> {{ $value['Ocupado'] }} </td>
                                        </tr>

                                        <?php } ?>
                                    @endif

                                </tbody>
                            </table>
                            <!---------------------Fim da Tabela com todos os leitos cadastrados--------------------->
                        </div>
                    </form>
                </div>
            </div>

          <!---------------------Fim da tela de Leitos Cadastrados --------------------->
            <!--<form action="/removerLeito" method="get">
                <div class="col-lg-6">
                    <label>Remover leito</label> <br> <br>-->
                    <!---------------------Inicio de remover leito--------------------->
                 <!--   <input id="focorrencia" name="focorrencia" type="text" maxlength="10" required>
                    <div>
                        <button class="btn-blue"> Deletar </button>
                    </div>
                </div>
            </form>-->
            <!---------------------Fim de remover leito--------------------->
        </div>
    </section>
</body>
</html>
