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
            <div class="box">
                <br>
                <!---------------------Inicio de cadastro de um novo leito--------------------->
                <form id="register">
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
                                            <th scope="col">Vagas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>A55</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>A34</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>B66</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>B11</td>
                                            <td>0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            <!---------------------Fim da Tabela com todos os leitos cadastrados--------------------->
                                <div class="col-lg-6">
                                    <label>Remover leito</label> <br> <br>
                                    <!---------------------Inicio de remover leito--------------------->
                                    <input id="focorrencia" name="focorrencia" type="text" maxlength="10" required>
                                    <div>
                                        <button class="btn-blue"> Deletar </button>
                                    </div>
                                </div>
                                    <!---------------------Fim de remover leito--------------------->
                            </form>
                        </div>

                    </div>
                </form>
                <!---------------------Fim da tela de cadastro leito--------------------->
            </div>
        </div>
    </section>
</body>
