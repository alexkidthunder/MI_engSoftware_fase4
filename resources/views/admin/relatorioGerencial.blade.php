<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <title>Relatorio Gerencial</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->
    <section>

        <div class="container-2">
            <h1>RELATORIO GERENCIAL</h1>
            <!---Botao de donwload ----->
            <form method="get" action="/baixarArquivos" class="download-icon" align="right">
                <button>
                    <i class="fas fa-download"></i>
                </button>
            </form>
            <!-- Fim do botão de donwload-->
            <div class="row">
                <!------- dado sobre pacientes--------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-user-injured"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $paci['COUNT(*)'] }}</b></h3>
                                    <h4><a>Pacientes Internados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre pacientes --------->

                <!------- dado sobre funcionários-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $func['COUNT(*)'] }}</b></h3>
                                    <h4><a>Funcionários Cadastrados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre funcionários --------->

                <!------- dado sobre  CID-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-disease"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{$cid["codCid"]}}</b></h3>
                                    <h4><a>CID mais frequente</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre CID--------->

                <!------- dado sobre Obito-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-book-dead"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $taxa }} %</b></h3>
                                    <h4><a>Taxa de óbito</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre obito--------->

                <!------- dado sobre idade media-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $media }}</b></h3>
                                    <h4><a>Idade Media entre Pacientes</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre idade media--------->

                <!------- dado sobre medicamento -------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-capsules"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $medic['Nome_Medicam'] }}</b></h3>
                                    <h4><a>Medicamento mais usado</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre medicamento--------->

                <!------- dado sobre leitos cadastrados-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $leito['COUNT(*)'] }}</b></h3>
                                    <h4><a>Quantidade de Leitos Cadastrados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre leitos cadastrados --------->

                <!------- dado sobre leitos ocupados-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-procedures"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $leitOcu['COUNT(*)'] }}</b></h3>
                                    <h4><a>Quantidade de Leitos Ocupados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre leitos ocupados--------->

                <!------- dado sobre enfermeiros chefes-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $EnfCh['COUNT(*)'] }}</b></h3>
                                    <h4><a>Enfermeiros Chefes Ativos</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre enfermeiros chefes--------->

                <!------- dado sobre enfermeiros-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-user-nurse"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $Enf['COUNT(*)'] }}</b></h3>
                                    <h4><a>Enfermeiros Ativos</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre enfermeiro--------->

                <!------- dado sobre estagiarios-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $Est['COUNT(*)'] }}</b></h3>
                                    <h4><a>Estagiarios Ativos</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre estagiario--------->

                <!------- dado sobre administradores-------->
                <div class="col-xl-3 col-lg-3 col-md-4 col-6">
                    <div class="card-menu text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-options-icon options-icon">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-options_title">
                                    <h3><b>{{ $adMin['COUNT(*)'] }}</b></h3>
                                    <h4><a>Administradores Cadastrados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre administradores--------->
            </div>
        </div>
    </section>
</body>
