<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <title>Meu perfil</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <h1>MEU PERFIL</h1>
    <section>
        <!-- <div class="container-1" id="perfil">
                    <div class="box">
                        <div class="change">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Nome</label> <br>
                                    <div class="box-blue">
                                        Vinícius Dias de Jesus Maciel
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Data de Nascimento</label> <br>
                                    <div class="box-blue">
                                        01/06/1999
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>CPF</label> <br>
                                    <div class="box-blue">
                                        01.345.678-99
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Sexo</label> <br>
                                    <div class="box-blue">
                                        Masculino
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <label>Email</label> <br>
                                    <div class="box-blue">
                                        vinicius@gmail.com
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Atribuição</label> <br>
                                    <div class="box-blue">
                                        Enfermeiro chefe
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div>
                        <a class="edit"> Atualizar informações</a>
                    </div>
                </div>
            </div>-->

        <div class="container-1" id="perfil">
            <div class="box">
                <div class="change">
                    <form id="register">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Nome</label> <br>
                                <input id="fnome" name="fnome" type="text" maxlength="50" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <label>Data de Nascimento</label> <br>
                                <input id="fnascimento" name="fnascimento" type="date" required>
                            </div>
                            <div class="col-lg-4">
                                <label>CPF</label> <br>
                                <input id="fcpf" name="fcpf" type="text" required maxlength="14"
                                    pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                            </div>
                            <div class="col-lg-4">
                                <div class="sex-form">
                                    <label>Sexo</label> <br>
                                    <input id="MASCULINO" name="fsexo" value="Masculino" type="button">
                                    <input id="FEMININO" name="fsexo" value="Feminino" type="button">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-8">
                                <label>Email</label> <br>
                                <input id="femail" name="femail" type="email" maxlength="50" required>
                            </div>
                        </div>
                        <div> 
                            <button type="submit" class="btn-blue">Editar</button>
                        </div>
                    </form>
                <div>
                    <form>
                        <div class="row">
                            <div class="col-lg-4">
                                <input id="senha" name="senha" placeholder="insira a nova senha">
                            </div>
                            <div class="col-lg-4">
                                <input id="senha-atual" name="senha-atual" placeholder="insira a senha atual">
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn-white">Alterar senha</button>
                            </div>
                    </form>
                </div>
                </div>

            </div>
        </div>

    </section>
    <script src="{{ asset('js/editarPerfil.js') }}"></script>
    <script>
        document.forms['teste']['fcpf'].disabled = true
        document.forms['teste']['fatribui'].disabled = true;

    </script>
</body>

</html>
