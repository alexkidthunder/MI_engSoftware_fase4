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

    <script src="{{ 'js/editarPerfil.js' }}" defer></script>

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
                                <input disabled id="fnome" name="fnome" type="text" maxlength="50" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <label>Data de Nascimento</label> <br>
                                <input disabled id="fnascimento" name="fnascimento" type="date" required>
                            </div>
                            <div class="col-lg-4">
                                <label>CPF</label> <br>
                                <input disabled id="fcpf" name="fcpf" type="text" required maxlength="14"
                                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                            </div>
                            <div class="col-lg-4">
                                <label>Sexo</label> <br>
                                <div class="row no-gutters">
                                    <div id="fmasc_div" class="col-lg-6 border-m content-center">
                                        <input type="radio" name="fsexo" value="Masculino" id="fmasc" disabled>
                                        <label for="fmasc" class="normal-label">Masculino</label>
                                        </input>
                                        <!--Usar o checked para deixar marcado-->
                                    </div>
                                    <div id="ffem_div" class="col-lg-6 border-f content-center">
                                        <input type="radio" name="fsexo" value="Feminino" id="ffem" disabled>
                                        <label for="ffem" class="normal-label">Feminino</label>
                                        </input>
                                        <!--Usar o checked para deixar marcado-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <label>Email</label> <br>
                                <input disabled id="femail" name="femail" type="email" maxlength="50" required>
                            </div>
                            <div class="col-lg-4" id="atribuiDiv">
                                <label for="fatribui">Atribuição</label>
                                <input disabled id="fatribui" name="fatribui" type="text" value="Enfermeiro">
                                <!--Alterar o Value de acordo com a atribuição-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4" id="corenDiv" style="display: none;">
                                <!--Mostrar isso somente se for Enfermeiro/Chefe-->
                                <label for="fcoren">Coren</label>
                                <input disabled id="fcoren" name="fcoren" type="text" value="Coren do Usuario" required
                                    maxlength="9">
                            </div>
                            <div class="col-lg-4" id="edit_div">
                                <br>
                                <div id="psw_info_div" style="display: none;">
                                    <button type="button" class="btn-white" name="psw_info" id="psw_info">Alterar
                                        senha</button>
                                </div>
                            </div>
                        </div>
                        <div id="edit_div" class="row">
                            <div class="col-lg" id="edit_info_div">
                                <button type="button" class="btn-blue" name="edit_info" id="edit_info">Editar
                                    informações</button>
                            </div>
                            <div class="col-lg" id="confirm_info_div" style="display: none;">
                                <button type="button" class="btn-blue" name="confirm_info"
                                    id="confirm_info">Salvar</button>
                                <!--Alterar para Submit depois-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="set-password">
                <div id="psw" style="display: none">
                    <h3 class="password-title text-center">Alterar senha</h3>
                    <br> <br>
                    <form class="content-center">
                        <div align="center">
                            <input type="password" id="senha-atual" name="senha-atual"
                                placeholder="insira a senha atual" required>
                        </div>
                        <div align="center">
                            <input type="password" id="senha" name="senha" placeholder="insira a nova senha" required>
                        </div>
                        <div align="center">
                            <input type="password" id="confirmacao" name="confirmacao"
                                placeholder="Confirme a nova senha" required>
                        </div>
                        <br>
                        <div class="content-right">
                            <div class="row">
                                <div class="col-lg">
                                    <button class="btn-gray">Cancelar</button>
                                </div>
                                <div class="col-lg">
                                    <button type="submit" class="btn-blue">Alterar senha</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
