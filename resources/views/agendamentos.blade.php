<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link href="{{ asset(' ') }}" rel="icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <title>Agendamentos</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->

    <section>

        <div class="container-1" id="scheduling">
            <h1>VERIFICAÇÃO DE AGENDAMENTOS</h1>
            <div class="row">
                <div class="col-lg">
                    @if ($errors->any())
                        <!--Verificando se existe qualquer erro -->
                        <div class="msg-error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <!--Percorre todos os erros-->
                                    <li>{{ $error }}</li>
                                    <!--Obtem o erro -->
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('msg'))
                        <!-- Verifica se a mensagem de erro foi instanciada -->
                        <div class="msg-sucess">
                            {{ session('msg') }}
                            <!--Obtem mensagem de erro -->
                        </div>
                    @endif
                    @if (session('msg-error'))
                        <!-- Verifica se a mensagem de erro foi instanciada -->
                        <div class="msg-error">
                            {{ session('msg-error') }}
                            <!--Obtem mensagem de erro -->
                        </div>
                    @endif
                </div>
            </div>
            <!---------------------- Agendamento  ---------------------->
            @for($i = 0;$i < count($infos)/9;$i++)
                <div class="box-scheduling" id="scheduling">
                    <!----- Fim das informações do agendamento ----->
                    <div class="row">
                        <!---------------------Hora--------------------->
                        <div class="col-sm-12 col-md-8 col-lg-8 text-center">
                            <div class="box-gray">
                                {{$infos["hora".$i]}}
                             </div>
                        </div>
                        <!---------------------Data--------------------->
                        <div class="col-sm-12 col-md-4 col-lg-4 text-center">
                            <div class="box-gray">
                                {{$infos["data".$i]}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!---------------------Nome do Medicamento--------------------->
                        <div class="col-sm-12 col-md-8 col-lg-8 text-center">
                            <div class="box-white scrolls">
                                {{$infos["medicamento".$i]}}
                             </div>
                        </div>
                        <!---------------------Posologia--------------------->
                        <div class="col-sm-12 col-md-4 col-lg-4 text-center">
                            <div class="box-white">
                                {{$infos["posologia".$i]}} ml
                            </div>
                        </div>
                    </div>  
                        <!------ Nome do paciente ao qual o agendamento pertence ---->
                        <form action="/prontuario" method="get">
                            <div class="row">
                                <input type="hidden" name='cpf' value="{{$infos['identificaP'.$i]}}">
                                <input type="hidden" name='numero' value='{{$infos["id".$i]}}'>
                                <div class="col-sm-12 col-md-8 col-lg-8">
                                    <button type="submit" class="btn-Patient scrolls text-center">{{$infos["paciente".$i]}}</button>
                                </div>
                                <!---------------------Leito da Paciente--------------------->
                                <div class="col-sm-12 col-md-4 col-lg-4 text-center">
                                    <div class="box-blue scrolls">
                                        Leito: {{$infos["leito".$i]}}
                                    </div>
                                </div>
                            </div>
                        </form>

                    <!---- Fim das informações do agendamento ------>

                    <div class="row">                  
                        <!---------- Botao para finalizar aplicação---------->
                        <div class="col-lg-9">
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-3" name="end_prep_btn_div">
                            <div>
                                <form action="/ACagendamentos" method="post">
                                @csrf
                                <input type="hidden" name="codA" value="{{ $infos['codA' . $i] }}">
                                <button href="/agendamentos" type="submit" class="btn-white" name="end_prep_btn">
                                    Ser Aplicador</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
            <!---------------------- Fim do agendamento ---------------------->
        </div>
    </section>
</body>

</html>
