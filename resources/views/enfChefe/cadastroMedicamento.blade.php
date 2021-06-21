<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
    <title>Cadastro de medicamentos</title>
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

    <!---------------------Inicio do cadastro de medicamentos--------------------->
    <h1>CADASTRO DE MEDICAMENTOS</h1>

        @if(Session::has('error'))
        <div class="msg-error" role="alert">
                {{Session::get('error')}}
        </div>
        @endif  

        @if(Session::has('success'))
        <div class="msg-sucess">
                {{Session::get('success')}}
        </div>
        @endif

    <section>
        <div class="container-1">
            <div class="box">
                <form id="register" action="{{ route('salvarMedicamento') }}" method="POST">
                    @csrf 
                    <div class="row">
                    <!---------------------Inserção do nome do medicamento--------------------->
                        <div class="col-lg-12">
                            <label>Nome</label> <br>
                            <input id="fnome" name="fnome" type="text" maxlength="50" required>
                        </div>
                    </div>
                    <div class="row">
                    <!---------------------Inserção do nome do fabricante--------------------->
                        <div class="col-lg-12">
                            <label>Fabricante</label> <br>
                            <input id="ffabricante" name="ffabricante" type="text" maxlength="50" required>
                        </div>
                    </div>

                    <div class="row">
                    <!---------------------Inserção da data de validade do medicamento--------------------->
                        <div class="col-md-6 col-lg-4">
                            <label>Data de validade</label> <br>
                            <input id="fvalidade" name="fvalidade" type="date" required>
                        </div>
                        <!---------------------Inserção da quantidadedo medicamento--------------------->
                        <div class="col-md-6 col-lg-4">
                            <label>Quantidade</label> <br>
                            <input id="fquantidade" name="fquantidade" type="number" required maxlength="15" required>
                        </div>
                    </div>

                    <div>
                        <button class="btn-blue"> Cadastrar </button>
                    </div>
                </form>
                <!---------------------Fim da tabela de cadastro de medicamento--------------------->

            </div>
        </div>
    </section>
</body>
</html>