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

    <title>Cadastro Agendamento</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <section>
        <div class="container-1">
            <h1>CADASTRO DE AGENDAMENTO</h1>
            <div class="box">
                <!--Buscar paciente-->
                <div class="content-center">
                    <h3>BUSCAR PACIENTE</h3>
                    <form class="search-bar">
                        <input name="cpf_user" id="cpf_user" type="text" placeholder="Informe o CPF" required
                            maxlength="11" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit" id="busca_user">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div id="user_Data" style="display: none;">
                <!--Infomações do Paciente-->
                <h3>Paciente</h3><br>
                <div class="box-gray">
                    Marcos Oliveira Santana
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="box-gray">
                            CPF: 011.988.999-00
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-gray">
                            CID: 0123456 BA
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-gray">
                            Leito: XXX
                        </div>
                    </div>
                </div>

                <!-- Cadastro do medicamento -->
                <br>
                <form id="register">
                    <div class="box-medicamento">
                        <div class="row">
                            <div class="col-lg-4">
                                <div>
                                    <label name="horario_agendamento">Horario</label>
                                    <input type="time" name="horario_agendamento" requerid>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label name="data_agendamento">Data</label>
                                    <input type="date" name="data_agendamento" requerid>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div>
                                    <label name="posologia_agendamento">Posologia</label>
                                    <input type="number" name="posologia_agendamento" requerid>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <label name="medicamento_agendamento">Medicamento</label>
                                    <input type="text" name="medicamento_agendamento" requerid>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div> <!-----FICA HIDDEN ATÉ QUE SEJA CLICALDO NO BOTÃO DE ALOCAR APLICADOR ----->
                                    <label name="aplicador_agendamento">Aplicador</label>
                                    <input type="text" name="aplicador_agendamento"
                                        placeholder="nome do aplicador">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <br>
                                <button class="btn-white"> Alocar aplicador </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn-blue"> Cadastrar </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
</body>
