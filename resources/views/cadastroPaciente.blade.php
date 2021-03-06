<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
    <script src="{{ ('js/mascara.min.js')}}"></script>

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <title>Cadastro de Paciente</title>
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
            <h1>CADASTRO DE PACIENTE</h1>

                <!----------- Mensagem de erro ------------->
                @if (Session::has('error'))
                    <div class="msg-error" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <!--------- Fim da mensagem de erro --------->

                <!---------- Mensagem de confirmação ---------->
                @if (Session::has('success'))
                    <div class="msg-sucess" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <!------ Fim da mensagem de confirmação ------->
                
            <div class="box">
                <!---------------- Cadastro do paciente ---------------->
                <form id="register" action="{{ route('salvarPaciente') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!----- Campo para inserção do nome ----->
                        <div class="col-md-12 col-lg-9">
                            <label>Nome</label> <br>
                            <input id="fnome" name="fnome" type="text" maxlength="50" required>
                        </div>
                        <!----- Campo para seleção do tipo sanguíneo ----->
                        <div class="col-lg-3">
                            <label>Tipo Sanguineo</label> <br>
                            <select id="fsanguineo" name="fsanguineo" required>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <!----- Campo para inserção da data de nascimento ----->
                        <div class="col-md-6 col-lg-4">
                            <label>Data de Nascimento</label> <br>
                            <input id="fnascimento" name="fnascimento" type="date" required>
                        </div>
                        <!----- Campo para inserção do CPF ----->
                        <div class=" col-md-6 col-lg-4">
                            <label>CPF</label> <br>
                            <input id="fcpf" name="fcpf" type="text" onkeyup="mascara('###.###.###-##',this,event,true)" 
                            required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        </div>
                        <!----- Campo para inserção do sexo ----->
                        <div class="col-lg-4">
                            <label>Sexo</label> <br>
                            <div class="row no-gutters">
                                <div class="col-6 col-md-3 col-lg border-m content-center">
                                    <input type="radio" name="fsexo" value="M" id="fmasc" required="required">Masculino</input>
                                </div>
                                <div class="col-6 col-md-3 col-lg border-f content-center">
                                    <input type="radio" name="fsexo" value="F" id="ffem">Feminino</input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----- Botão de cadastrar ----->
                    <div>
                        <button type="submit" class="btn-blue"> Cadastrar </button>
                    </div>
                </form>
                <!---------------- Fim do cadastro do paciente ---------------->

            </div>
        </div>
    </section>
</body>

</html>
