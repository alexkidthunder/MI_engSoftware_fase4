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
    
    <title>Cadastro de Medicamentos</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    
    @if(Session::has('error'))
    <div class="msg-error" role="alert">
            {{Session::get('error')}}
    </div>
    @endif  

    @if(Session::has('success'))
    <div class="msg-sucess" role="alert">
            {{Session::get('success')}}
    </div>
    @endif
    <!---------------------Inicio do cadastro de medicamentos--------------------->
    <h1>CADASTRO DE MEDICAMENTOS</h1>
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
                        <div class="col-lg-4">
                            <label>Data de Validade</label> <br>
                            <input id="fvalidade" name="fvalidade" type="date" required>
                        </div>
                        <!---------------------Inserção da quantidadedo medicamento--------------------->
                        <div class="col-lg-4">
                            <label>Quantidade</label> <br>
                            <input id="fquantidade" name="fquantidade" type="text" required maxlength="40" required>
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