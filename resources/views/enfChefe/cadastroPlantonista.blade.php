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
        <div class="container-1" id="on-duty">
            <h1>PLANTONISTAS</h1>

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
                
                <div class="row">
                    <div class="col"> <!--NOME-->
                        <div class="row no-gutters title"> <!--CABEÇÁRIO NOME-->
                            NOME
                        </div>
                        @foreach($plantonistas as $plantonista)
                        <div class="row no-gutters box-blue"> <!--FUNCIONÁRIO NOME-->
                            <span style="white-space: nowrap">{{$plantonista['Nome']}}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="col"> <!--CARGO-->
                        <div class="row no-gutters title"> <!--CABEÇÁRIO CARGO -->
                            CARGO
                        </div>
                        @foreach($plantonistas as $plantonista)
                        <div class="row no-gutters box-blue"> <!--FUNCIONÁRIO CARGO -->
                            <span style="white-space: nowrap">{{$plantonista['Cargo']}}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="col"> <!--EM PLANTÃO-->
                        <div class="row no-gutters title"> <!--align="center"-->
                            <div class="mx-auto">
                                <span style="white-space: nowrap">EM PLANTÃO</span> <!--CABEÇÁRIO EM PLANTÃO -->
                            </div>
                        </div>
                        @foreach($plantonistas as $plantonista)
                        <div class="row no-gutters box-button"> <!--FUNCIONÁRIO EM PLANTÃO-->
                            <input type="checkbox" class="mx-auto" name="{{$plantonista['CPF']}}" id="{{$plantonista['CPF']}}" {{ $plantonista['Plantao'] }}  >
                            <!-- {{$plantonista['CPF']}} -->
                        </div>
                        
                        @endforeach
                    </div>
                </div>
                @endif

                 <div> 
                 <h4 id="num_alteracao">Alterações</h4>
                 
                 <button id="alterar" type="submit"                                                 >Alterar</button> 
                                                  <!--  class="container-button btn-white hide" -->
                </div> 
               
            </div>
          
            </form>

            
        </div>
    </section>
</body>
</html>