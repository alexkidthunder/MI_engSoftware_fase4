<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    
    <title>Cadastro Plantonista</title>

</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->
    <section>
        <div class="container-2" id="on-duty">
            <h1>CADASTRO DE PLANTONISTAS</h1>

            <!----------- MENSAGENS DE ERRO ----------------->
            @if (session('msg-error'))
                <div class='msg-error'> {{ session('msg-error') }}</div>
            @endif
            <!----------- MENSAGENS DE SUCESSO----------------->
            @if (session('msg-sucess'))
                <div class='msg-sucess'> {{ session('msg-sucess') }}</div>
            @endif

            @if(isset($plantonistas))
            <form action="/cadastrarPlantonistas" method="get">
            <div class="box-on-duty">
                <!--------- Cabeçalho --------->
                <div class="title">
                    <div class="row">
                        <div class="col-5 col-sm-5 col-md-6 col-lg-6">
                            NOME
                        </div>
                        <div class="col-3 col-sm-3 col-md-4 col-lg-4">
                            CARGO
                        </div>
                        <div class="col-4 col-sm-4 col-md-2 col-lg-2 text-center">
                            EM PLANTÃO
                        </div>
                    </div>
                </div>
                <!--------fim do cabeçalho--------->

                <!----------Plantonistas---------->
                @foreach($plantonistas as $plantonista)
                <div class="box-blue">
                    <div class="row">
                        <!--NOME DO FUNCIONÁRIO-->
                        <div class="col-5 col-sm-5 col-md-6 col-lg-6 text-left">
                                {{$plantonista['Nome']}}
                        </div>
                        <!--CARGO DO FUNCIONÁRIO-->
                        <div class="col-3 col-sm-3 col-md-4 col-lg-4 text-left">
                                {{$plantonista['Cargo']}}
                        </div>
                        <!--EM PLANTÃO-->
                        <div class="col-4 col-sm-4 col-md-2 col-lg-2" align="center">
                                <input type="checkbox" name="{{$plantonista['CPF']}}" id="{{$plantonista['CPF']}}" {{ $plantonista['Plantao'] }}  >
                                <!-- {{$plantonista['CPF']}} -->
                        </div>
                    </div>
                </div>
                @endforeach
                <!----------fim de Plantonistas---------->
                <div class="container-button"> 
                    <button class="btn-white" id="alterar" type="submit">Alterar</button>
                </div> 
               
            </div>
            </form>
            @endif
        </div>
    </section>
</body>
</html>
