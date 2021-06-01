<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <title>Cadastro e remoção de Leito</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <section>

        <div class="container-1">
            <h1>CADASTRO E REMOÇÃO DE LEITO</h1>
              
              <!-- MENSAGENS DO SISTEMA-->
            
            @if (session('msg-sucess'))
            <!-- Verifica se a mensagem de erro foi instanciada -->
            <div class="msg-sucess">
                {{session('msg-sucess')}}
                <!--Obtem mensagem de erro -->
            </div>
            @endif

            @if (session('msg-error'))
            <!-- Verifica se a mensagem de erro foi instanciada -->
            <div class="msg-error">
                {{session('msg-error')}}
                <!--Obtem mensagem de erro -->
            </div>
            @endif

            <!-- FIM MENSAGENS DO SISTEMA-->

            <div class="box">
                <br>
                <!---------------------Inicio de cadastro de um novo leito--------------------->
                <form id="register" method="get" action="/cadastrarLeito">
                    <div class="box-cadastroLeito">
                        <div class="row">
                            <div class="col-lg-4">
                                <div>
                                    <label name="Leito">Leito:</label>
                                    <input type="text" name="Leito" requerid>
                                </div>
                            </div>
                            <button type="submit" class="btn-blue"> Cadastrar </button>
                        </div>

                </form>
                <!---------------------Fim de cadastro de leitos--------------------->
                <div class="box-scheduling" , id="container-teste4">
                    <form id="register">
                        <div class="row">
                            <!---------------------Inicio da Tabela com todos os leitos cadastrados--------------------->
                            <h3>Tabela de Leitos</h3>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Leito</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($leitos))
                                <?php
                                foreach ($leitos as $value) {
                                ?>
                                    <tr>
                                        <td> {{ $value['Identificacao'] }} </td>
                                        <td> {{ $value['Ocupado']}} </td>
                                    </tr>

                                <?php } ?>
                                @endif

                            </tbody>
                        </table>
                        <!---------------------Fim da Tabela com todos os leitos cadastrados--------------------->

                    </form>
                </div>

            </div>

            <!---------------------Fim da tela de Leitos Cadastrados --------------------->
            <form action="/removerLeito" method="get">
                <div class="col-lg-6">
                    <label>Remover leito</label> <br> <br>
                    <!---------------------Inicio de remover leito--------------------->
                    <input id="focorrencia" name="focorrencia" type="text" maxlength="10" required>
                    <div>
                        <button class="btn-blue"> Deletar </button>
                    </div>
                </div>
            </form>
            <!---------------------Fim de remover leito--------------------->


        </div>
        </div>


    </section>
</body>