
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ ('js/cadastroUsuario.js') }}" defer></script>
    <script src="{{ ('js/mascara.min.js')}}"></script>
    <script src="{{ ('js/notification.js')}}"></script>

    <title>Cadastro de funcionários</title>
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

    <h1>CADASTRO DE FUNCIONÁRIO</h1>

        <!-------Mensagem de erro------->
        @if(Session::has('error'))
        <div class="msg-error" role="alert">
                {{Session::get('error')}}
        </div>
        @endif  
        <!-------Mensagem de sucesso------->
        @if(Session::has('success'))
        <div class="msg-sucess">
                {{Session::get('success')}}
        </div>
        @endif
    
    <section>
        <div class="container-1"> <!--Inicio do form para se cadastrar um usuário-->
            <div class="box">
                <form id="register" action="{{ route('salvarUsuario') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="fnome">Nome</label> <br> <!--Campo onde se digita o nome do usuário a ser cadastrado-->
                            <input id="fnome" name="fnome" type="text" maxlength="50" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <label style="white-space: nowrap" for="fnascimento">Data de Nascimento</label> <br> <!--Campo onde se digita a data de nascimento do usuário a ser cadastrado-->
                            <input id="fnascimento" name="fnascimento" type="date" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label for="fcpf">CPF</label> <br> <!--Campo onde se digita o CPF do usuário a ser cadastrado-->
                            <input id="fcpf" name="fcpf" type="text" onkeyup="mascara('###.###.###-##',this,event,true)" 
                            required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        </div>
                        <div class="col-lg-4">
                            <label>Sexo</label> <br>
                            <div class="row no-gutters"> <!--Campo onde é selecionado qual o sexo do usuário a ser cadastrado-->
                                <div class="col-6 col-md-3 col-lg border-m content-center">
                                    <input type="radio" name="fsexo" value="M" id="fmasc" required="required">Masculino</input>
                                </div>
                                <div class="col-6 col-md-3 col-lg border-f content-center">
                                    <input type="radio" name="fsexo" value="F" id="ffem">Feminino</input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <label for="femail">Email</label> <br> <!--Campo onde se digita o Email do usuário a ser cadastrado-->
                            <input id="femail" name="femail" type="email" maxlength="50" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="fatribui">Atribuição</label> <br>
                            <select id="fatribui" name="fatribui" required> <!--Select onde se escolhe qual a atribuição do usuário a ser cadastrado-->
                                <option value="Administrador">Administrador</option>
                                <option value="Enfermeiro Chefe">Enfermeiro Chefe</option>
                                <option value="Enfermeiro">Enfermeiro</option>
                                <option value="Estagiário">Estagiario</option>
                            </select>
                        </div>
                    </div>
                    <div id="corenDiv" class="hide">
                        <div  class="row">
                            <div class="col-lg-4">
                                <label for="fcoren">Coren</label> <!--Campo do coren--> <!--Fica invisível se o usuário estiver sendo cadastrado como um Estagiário-->
                                <!--Por Lei o Coren do enfermeiro tem que obedecer o estado atual onde o mesmo atua, por isso automaticamente já será preenchido com BA-->
                                <input placeholder="Informe o Coren" id="fcoren" name="fcoren" type="text" maxlength="14" onkeyup="mascara('BA-###.###.###',this,event,true)"  pattern="\d{2}\-\d{3}.\d{3}.\d{3}" required>
                            </div>
                        </div>
                    </div>
                    <div> <!--Botão para enviar o forms do cadastro de usuário-->
                        <button type="submit" class="btn-blue"> Cadastrar </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>