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
    @if(isset($_SESSION['administrador']))
        @include('layouts.navbar-adm')
    @else
        @include('layouts.navbar')
    @endif
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
        <div class="container-1" id="perfil">
            <h1>MEU PERFIL</h1>

            <!---------------------Mensagens de erro--------------------->
            <div class="row">
                <div class="col-lg">
                    @if ($errors->any()) <!--Verificando se existe qualquer erro -->
                        <div class="msg-error">
                            <ul>
                                @foreach ($errors->all() as $error) <!--Percorre todos os erros-->
                                    <li>{{ $error }}</li> <!--Obtem o erro -->
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('msg')) <!-- Verifica se a mensagem de erro foi instanciada -->
                        <div class="msg-sucess">
                            {{session('msg')}} <!--Obtem mensagem de erro -->
                        </div>
                    @endif
                    @if (session('msg-error')) <!-- Verifica se a mensagem de erro foi instanciada -->
                        <div class="msg-error">
                            {{session('msg-error')}} <!--Obtem mensagem de erro -->
                        </div>
                    @endif
                </div>
            </div>
            <!---------------------fim de mensagens de erro--------------------->
             
            <!------------ Informações pessoais do usuário ------------>
            <div class="box" id="perfilArea">
                <div class="change">
                    <form method="post" action="/alterarDados" id="register">
                        @csrf
                        <!------------ Nome do usuário ------------>
                            <div class="row">
                                @if(isset($usuario['nome']))
                                    <div class="col-lg-12">
                                        <label>Nome</label> <br>
                                        <input disabled id="fnome" name="fnome" type="text" maxlength="50" value="{{$usuario['nome']}}">
                                    </div>
                                @endif
                            </div>         
                            <div class="row">
                                <!------------ Data de nascimento ------------>
                                @if(isset($usuario['nascimento']))
                                    <div class="col-lg-4">
                                        <label style="white-space: nowrap">Data de Nascimento</label> <br>
                                        <input disabled id="fnascimento" name="fnascimento" type="date" value="{{$usuario['nascimento']}}">
                                    </div>
                                @endif
                                <!------------ CPF do usuário ------------>
                                @if(isset($_SESSION['administrador']))
                                    <div class="col-lg-4">
                                        <label>CPF</label> <br>
                                        <input disabled id="fcpf" name="fcpf" type="text" maxlength="14"
                                        pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{$_SESSION['administrador']}}">
                                    </div>
                                @endif
                                @if(isset($_SESSION['enfermeiroChefe']))
                                    <div class="col-lg-4">
                                        <label>CPF</label> <br>
                                        <input disabled id="fcpf" name="fcpf" type="text" maxlength="14"
                                        pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{$_SESSION['enfermeiroChefe']}}">
                                    </div>
                                @endif
                                @if(isset($_SESSION['enfermeiro']))
                                    <div class="col-lg-4">
                                        <label>CPF</label> <br>
                                        <input disabled id="fcpf" name="fcpf" type="text" maxlength="14"
                                        pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{$_SESSION['enfermeiro']}}">
                                    </div>
                                @endif
                                @if(isset($_SESSION['estagiario']))
                                    <div class="col-lg-4">
                                        <label>CPF</label> <br>
                                        <input disabled id="fcpf" name="fcpf" type="text" maxlength="14"
                                        pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{$_SESSION['estagiario']}}">
                                    </div>
                                @endif
                                <!------------ Sexo do usuário------------>
                                @if(isset($usuario['sexo']))
                                    <div class="col-lg-4">
                                        <label>Sexo</label> <br>
                                        @if($usuario['sexo'] == "M")
                                            <div class="row no-gutters">
                                                <div id="fmasc_div" class="col-lg-6 border-m content-center radial-no-edit">
                                                    <input type="radio" name="fsexo" value="M" id="fmasc" checked disabled required="required">
                                                    <label for="fmasc" class="normal-label">Masculino</label>
                                                    <!--Usar o checked para deixar marcado-->
                                                </div>
                                                <div id="ffem_div" class="col-lg-6 border-f content-center radial-no-edit">
                                                    <input type="radio" name="fsexo" value="F" id="ffem" disabled>
                                                    <label for="ffem" class="normal-label">Feminino</label>
                                                        <!--Usar o checked para deixar marcado-->
                                                </div>
                                            </div>
                                        @elseif($usuario['sexo'] == "F")
                                            <div class="row no-gutters">
                                                <div id="fmasc_div" class="col-lg-6 border-m content-center radial-no-edit">
                                                    <input type="radio" name="fsexo" value="M" id="fmasc" disabled>
                                                    <label for="fmasc" class="normal-label">Masculino</label>
                                                    <!--Usar o checked para deixar marcado-->
                                                </div>
                                                <div id="ffem_div" class="col-lg-6 border-f content-center radial-no-edit">
                                                    <input type="radio" name="fsexo" value="F" id="ffem"  checked disabled>
                                                    <label for="ffem" class="normal-label">Feminino</label>
                                                    <!--Usar o checked para deixar marcado-->
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <!------------ E-mail do usuário------------>
                                @if(isset($usuario['email']))
                                    <div class="col-lg-8">
                                        <label>E-mail</label> <br>
                                        <input disabled id="femail" name="femail" type="email" maxlength="50" value="{{$usuario['email']}}">
                                    </div>
                                @endif
                                <!------------ Atribuição do usuário------------>
                                @if(isset($_SESSION['enfermeiro']))
                                    <div class="col-lg-4" id="atribuiDiv">
                                        <label for="fatribui">Atribuição</label>
                                        <input disabled id="fatribui" name="fatribui" type="text" value="Enfermeiro">
                                        <!--Alterar o Value de acordo com a atribuição-->
                                    </div>
                                @endif
                                @if(isset($_SESSION['enfermeiroChefe']))
                                    <div class="col-lg-4" id="atribuiDiv">
                                        <label for="fatribui">Atribuição</label>
                                        <input disabled id="fatribui" name="fatribui" type="text" value="Enfermeiro Chefe">
                                        <!--Alterar o Value de acordo com a atribuição-->
                                    </div>
                                @endif
                                @if(isset($_SESSION['estagiario']))
                                    <div class="col-lg-4" id="atribuiDiv">
                                        <label for="fatribui">Atribuição</label>
                                        <input disabled id="fatribui" name="fatribui" type="text" value="Estagiario">
                                        <!--Alterar o Value de acordo com a atribuição-->
                                    </div>
                                @endif
                                @if(isset($_SESSION['administrador']))
                                    <div class="col-lg-4" id="atribuiDiv">
                                        <label for="fatribui">Atribuição</label>
                                        <input disabled id="fatribui" name="fatribui" type="text" value="Administrador">
                                        <!--Alterar o Value de acordo com a atribuição-->
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <!------------ Coren se usuário for enfermeiro ou enfermeiro chefe ------------>
                                @if(isset($usuario['coren']))
                                    <div class="col-lg-4" id="corenDiv">
                                        <!--Mostrar isso somente se for Enfermeiro/Chefe-->
                                        <label for="fcoren">Coren</label>
                                        <input disabled id="fcoren" name="fcoren" type="text" value="{{$usuario['coren']}}" maxlength="9">
                                    </div>
                                @endif
                                <!------------ Botão para alterar a senha ------------>
                                <div class="col-lg-4" id="edit_div">
                                    <br>
                                    <div id="psw_info_div">
                                        <button type="button" class="btn-white" name="psw_info" id="psw_info">Alterar senha</button>
                                    </div>
                                </div>
                            </div>
                            <div id="edit_div" class="row">
                                <!------------ Botão para editar as infomações ------------>
                                <div class="col-lg" id="edit_info_div">
                                    <button type="button" class="btn-blue" name="edit_info" id="edit_info">Editar informações</button>
                                </div>
                                <!------------ Botão para cancelar ------------>
                                <div class="col-lg hide" id="confirm_info_div">
                                    <button type="Submit" class="btn-blue" name="confirm_info" id="confirm_info">Salvar</button>
                                    <!--Alterar para Submit depois-->
                                </div>
                            </div>
                        <!--Fim do Csrf-->
                    </form>
                </div>
            </div>
            <!------------ Fim das informações pessoais do usuário ------------>

            <!------------ Alteração de senha ------------>
            <div class="set-password hide" id="pswArea">
                <div>
                    <h3 class="password-title text-center">Alterar senha</h3>
                    <br> <br>
                    <form method="post" action="/alterarSP" class="content-center">
                        @csrf
                        <!------------ Senha atual ------------>
                            <div align="center">
                                <input type="password" id="senha-atual" name="senhaAtual"
                                    placeholder="Insira a senha atual">
                            </div>
                            <!------------ Nova senha ------------>
                            <div align="center">
                                <input type="password" id="senha" name="senha" placeholder="Insira a nova senha">
                            </div>
                            <!------------ Confirmação da nova senha ------------>
                            <div align="center">
                                <input type="password" id="confirmacao" name="confirmacao"
                                    placeholder="Confirme a nova senha">
                            </div>
                            <br>
                            <div>
                                <div class="row" id="psw-field-btn">
                                    <!------------ Botão para cancelar ------------>
                                    <div class="col-lg col-md col-sm">
                                        <button id="cancelar" type="button" class="btn-gray">Cancelar</button>
                                    </div>
                                    <!------------ Botão para alterar a senha ------------>
                                    <div class="col-lg col-md col-sm">
                                        <button id="alterarSenha" type="submit" class="btn-blue">Alterar senha</button>
                                    </div>
                                </div>
                            </div>
                        <!--Fim do Csrf-->
                    </form>
                </div>
            </div>
            <!------------ Fim da alteração de senha ------------>
        </div>
    </section>
</body>

</html>