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

    <h1>RELATORIO GERENCIAL</h1>
        <section> 
        
            <div class="container-2">
            <!---Botao de donwload ----->
        <form method="get" action="/baixarArquivos" class="download-icon" align="right">
                <button>
                    <i class="fas fa-download"></i>
                </button>
            </form>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                                    <h2 class="card-options_title"><b>{{$paci["COUNT(*)"]}}</b></h2>
                                <h4 class="card-options_title"><a
                                    >Pacientes Internados</a></h4>
                            </div>       
                        </div>
                    </div> 
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >{{$func["COUNT(*)"]}}</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >Funcionários Cadastrados</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >A22</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >CID mais frequente</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >{{$taxa}} %</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >Taxa de óbito</a></h4>
                        </div>
                    </div>  
                </div> 
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >{{$media}}</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >Idade Media entre Pacientes</a></h4>
                        </div>
                    </div> 
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h4 class="card-options_title"><b
                                >Dipirona</b></h4>
                            </div>
                            <h4 class="card-options_title"><a
                                >Medicamento mais usado</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >{{$leito["COUNT(*)"]}}</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >Quantidade de Leitos Cadastrados</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >{{$leitOcu["COUNT(*)"]}}</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >Quantidade de Leitos Ocupados</a></h4>
                        </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                                    <h2 class="card-options_title"><b>{{$EnfCh["COUNT(*)"]}}</b></h2>
                                <h4 class="card-options_title"><a
                                    >Enfermeiros Chefes Ativos</a></h4>
                            </div>       
                        </div>
                    </div> 
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >{{$Enf["COUNT(*)"]}}</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >Enfermeiros Ativos</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >{{$Est["COUNT(*)"]}}</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >Estagiarios Ativos</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card-menu text-center card-options">
                            <div class="card-options-icon options-icon">
                            <h2 class="card-options_title"><b
                                >{{$adMin["COUNT(*)"]}}</b></h2>
                            </div>
                            <h4 class="card-options_title"><a
                                >Administradores Cadastrados</a></h4>
                        </div>
                    </div>  
                </div>         
            </div>            
        </section> 
 </body>
