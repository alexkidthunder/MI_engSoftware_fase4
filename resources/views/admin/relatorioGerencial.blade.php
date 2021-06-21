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

        <div class="container-2">
            <h1>RELATORIO GERENCIAL</h1>
            <!---Botao de donwload ----->
            <div id="screen-icon">
                <form method="get" action="/baixarArquivos" class="download-icon">
                    <button>
                        <i class="fas fa-download"></i>
                    </button>
                        <input type="hidden" name="listagem" value="{{$paci['COUNT(*)'].'|'.$func['COUNT(*)'].'|'.$cid['codCid'].'|'.$taxa.'|'.$media.'|'.$medic['Nome_Medicam'].'|'.$leito['COUNT(*)'].'|'.$leitOcu['COUNT(*)'].'|'.$EnfCh['COUNT(*)'].'|'.$Enf['COUNT(*)'].'|'.$Est['COUNT(*)'].'|'.$adMin['COUNT(*)'] }}">
                        <input type="hidden" name="tela" value="rg">
                </form>
            </div>
            <!-- Fim do botão de donwload-->
            <div class="row">
                <!------- dado sobre pacientes--------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-user-injured"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $paci['COUNT(*)'] }}</b></h5>
                                    <h4><a>Pacientes Internados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre pacientes --------->

                <!------- dado sobre funcionários-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                            <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col-9">
                            <div class="card-relatorio_title">
                                    <h5><b>{{ $func['COUNT(*)'] }}</b></h5>
                                    <h4><a>Funcionários Cadastrados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre funcionários --------->
            </div>
            <div class="row">
                <!------- dado sobre  CID-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                <i class="fa fa-thermometer-full" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{$cid["codCid"]}}</b></h5>
                                    <h4><a>CID mais frequente</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre CID--------->

                <!------- dado sobre Obito-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-book-dead"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $taxa }} %</b></h5>
                                    <h4><a>Taxa de óbito</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre obito--------->
            </div>
            <div class="row">
                <!------- dado sobre idade media-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                <i class="fa fa-heartbeat" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $media }}</b></h5>
                                    <h4><a>Idade Media entre Pacientes</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre idade media--------->

                <!------- dado sobre medicamento -------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-capsules"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $medic['Nome_Medicam'] }}</b></h5>
                                    <h4><a>Medicamento mais usado</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre medicamento--------->
            </div>
            <div class="row">
                <!------- dado sobre leitos cadastrados-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $leito['COUNT(*)'] }}</b></h5>
                                    <h4><a>Quantidade de Leitos Cadastrados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre leitos cadastrados --------->

                <!------- dado sobre leitos ocupados-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-procedures"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $leitOcu['COUNT(*)'] }}</b></h5>
                                    <h4><a>Quantidade de Leitos Ocupados</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre leitos ocupados--------->
            </div>
            <div class="row">
                <!------- dado sobre enfermeiros chefes-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $EnfCh['COUNT(*)'] }}</b></h5>
                                    <h4><a>Enfermeiros Chefes Ativos</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre enfermeiros chefes--------->

                <!------- dado sobre enfermeiros-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-user-nurse"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $Enf['COUNT(*)'] }}</b></h5>
                                    <h4><a>Enfermeiros Ativos</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre enfermeiro--------->
            </div>
            <div class="row">
                <!------- dado sobre estagiarios-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $Est['COUNT(*)'] }}</b></h5>
                                    <h4><a>Estagiarios Ativos</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!------- fim do dado sobre estagiario--------->

                <!------- dado sobre administradores-------->
                <div class="col-xl-6 col-lg-6 col-md-8 col-12">
                    <div class="card-relatorio text-center card-options">
                        <div class="row">
                            <div class="col-3">
                                <div class="card-relatorio-icon relatorio-icon">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-relatorio_title">
                                    <h5><b>{{ $adMin['COUNT(*)'] }}</b></h5>
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
