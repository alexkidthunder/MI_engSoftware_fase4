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
                        <div class="col-lg-9">
                            <label>Nome</label> <br>
                            <input id="fnome" name="fnome" type="text" maxlength="50" required>
                        </div>
                        <!----- Campo para seleção do tipo sanguíneo ----->
                        <div class="col-lg-3">
                            <label>Tipo Sanguineo</label> <br>
                            <select id="fsanguineo" name="fsanguineo">
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
                        <div class="col-lg-4">
                            <label>Data de Nascimento</label> <br>
                            <input id="fnascimento" name="fnascimento" type="date" required>
                        </div>
                        <!----- Campo para inserção do CPF ----->
                        <div class="col-lg-4">
                            <label>CPF</label> <br>
                            <input id="fcpf" name="fcpf" type="text" onkeyup="mascara('###.###.###-##',this,event,true)" 
                            required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        </div>
                        <!----- Campo para inserção do sexo ----->
                        <div class="col-lg-4">
                            <label>Sexo</label> <br>
                            <div class="row no-gutters">
                                <div class="col-lg border-m content-center">
                                    <input type="radio" name="fsexo" value="M" id="fmasc">Masculino</input>
                                </div>
                                <div class="col-lg border-f content-center">
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
