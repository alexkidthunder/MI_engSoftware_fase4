<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
    <script src="{{ ('js/editarPerfil.js') }}" defer></script>

    <title>Meu perfil</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <h1>MEU PERFIL</h1>
    <section>
        <div class="container-1" id="perfil">
            <div class="box">
                <div class="change">
                    <form id="register">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Nome</label> <br>
                                <input id="fnome" name="fnome" type="text" maxlength="50" required readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <label>Data de Nascimento</label> <br>
                                <input id="fnascimento" name="fnascimento" type="date" required readonly>
                            </div>
                            <div class="col-lg-4">
                                <label>CPF</label> <br>
                                <input id="fcpf" name="fcpf" type="text" required readonly maxlength="14"
                                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                            </div>
                            <div class="col-lg-4">
                                <label>Sexo</label> <br>
                                <input id="fsexo" name="fsexo" type="text" value="feminino" required readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <label>Email</label> <br>
                                <input id="femail" name="femail" type="email" maxlength="50" required readonly>
                            </div>
                            <div class="col-lg-4" id="atribuiDiv">
                                <label for="fatribui">Atribuição</label>
                                <input id="fatribui" name="fatribui" type="text" value="Enfermeiro" readonly> <!--Alterar o Value de acordo com a atribuição-->
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-lg-4" id="corenDiv" style="display: none;"> <!--Mostrar isso somente se for Enfermeiro/Chefe-->
                                <label for="fcoren">Coren</label>
                                <input id="fcoren" name="fcoren" type="text" value="Coren do Usuario" readonly>
                            </div>
                        </div>
                        <div id="edit_div" class="row">
                            <div class="col-lg" id="edit_info_div">
                                <button type="button" class="btn-blue" name="edit_info" id="edit_info">Editar informações</button>
                            </div>
                            <div class="col-lg" id="psw_info_div" style="display: none;">
                                <button type="button" class="btn-blue" name="psw_info" id="psw_info">Alterar Senha</button>
                            </div>
                            <div class="col-lg" id="confirm_info_div" style="display: none;">
                                <button type="button" class="btn-blue" name="confirm_info" id="confirm_info">Confirmar mudanças</button> <!--Alterar para Submit depois-->
                            </div>
                        </div>
                    </form>
                    <div id="psw" style="display: none">
                    <h3 class="text-center">Alterar senha</h3>
                        <form class="content-center">
                            <div class="row">
                                <div class="col-lg">
                                    <input type="password" id="senha-atual" name="senha-atual" placeholder="insira a senha atual" required>
                                </div>
                                <div class="col-lg">
                                    <input type="password" id="senha" name="senha" placeholder="insira a nova senha" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <button type="button" id="fback" class="btn-white">Voltar</button> <!--Fazer Atualizar a Página-->
                                </div>
                                <div class="col-lg">
                                    <button type="submit" class="btn-white">Confirmar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        document.forms['teste']['fcpf'].disabled = true
        document.forms['teste']['fatribui'].disabled = true;

    </script>
</body>

</html>
