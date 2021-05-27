<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <title>Cadastro Prontuario</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <section>

        <div class="container-1">
            <h1>CADASTRO DE PRONTUARIO</h1>

            <!------------- Busca do paciente ------------->
            <div id="search">
                <div class="box">
                    <div class="content-center">
                        <h3>BUSCAR PACIENTE</h3>
                        <form class="search-bar">
                            <!--- Campo para a inserção do CPF do paciente --->
                            <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required
                                maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!---------- Fim da Busca do paciente ---------->

            <!---------- Infomações do Paciente buscado ---------->
            <h3>Paciente</h3><br>
            <!------ Nome do Paciente ------>
            <div class="box-gray">
                Marcos Oliveira Santana
            </div>
            <div class="row">
                <!------ CPF do Paciente ------>
                <div class="col-lg-4">
                    <div class="box-gray">
                        CPF: 011.988.999-00
                    </div>
                </div>
                <!------ CID do Paciente ------>
                <div class="col-lg-4">
                    <div class="box-gray">
                        CID: C00
                    </div>
                </div>
            </div>
            <!------ Fim das infomações do Paciente buscado ------>

            <br>
            <!---------- Cadastro do prontuário ---------->
            <form id="register">
                <div class="box-cadastroLeito">
                    <div class="row">
                        <!------ Nome do leito de internamento do Paciente ------>
                        <div class="col-lg-4">
                        <!------ Aqui em baixo o Leito cadastrado no BD, como isso não ta feito, vai um exemplo ------>
                        <label name="inserir_leito">Selecione o leito</label>
                        <form>
                        <select id="LeitoSelect" name="Leito">
                        <option value="A01">A 01</option>
                        <option value="A02">A 02</option>
                        <option value="A03">A 03</option>
                        <option value="B01">B 01</option>
                        <option value="B02">B 02</option>
                        <option value="B03">B 03</option> 
                        <option value="B04">B 04</option>   
                        <option value="C01">C 01</option>                    
                        <option value="C02">C 02</option>
                        </select>
                        </form>
                        </div>
                        <!------ Data de internação do Paciente ------>
                        <div class="col-lg-4">
                            <div>
                                <label name="data_internacao">Data de Internação</label>
                                <input type="date" name="data_internacao" requerid>
                            </div>
                        </div>
                    </div>
                    <!------ Botão para cadastrar ------>
                    <div>
                        <button type="submit" class="btn-blue"> Cadastrar </button>
                    </div>
                </div>
            </form>
            <!---------- Fim do cadastro do prontuário ---------->
        </div>
    </section>
</body>

</html>

