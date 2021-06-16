


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
    <script src="js/scriptprontuario.js" defer></script>

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    {{ $i = 0 }}
    {{ $j = 0 }}
    {{ $k = 0 }}
    {{ $l = 0 }}
    <title>PRONTÚARIO</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
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

    <!----------Botão de donwload------------>
    <div id="screen-icon">
        <form method="get" action="/baixarArquivos" class="download-icon">
            <button>
                <i class="fas fa-download"></i>
            </button>
            @if(isset($paciente))
            <input type="hidden" name="listagemP" value="{{implode('|',$paciente)}}">
            @if(isset($infosA))
            <input type="hidden" name="listagemA" value="{{implode('|',$infosA)}}">
            @endif
            @if(isset($infosM))
            <input type="hidden" name="listagemM" value="{{implode('|',$infosM)}}">
            @endif
            @if(isset($infosC))
            <input type="hidden" name="listagemC" value="{{implode('|',$infosC)}}">
            @endif
            @if(isset($infosO))
            <input type="hidden" name="listagemO" value="{{implode('|',$infosO)}}">
            @endif
            <input type="hidden" name="tela" value="prontuario">
            @endif
        </form>
    </div>
    <!--------Fim do botão de donwload-------->

    <section>

        <!---------------------Mensagens de erro--------------------->
        <div>
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
        
        <!---------------------fim de Mensagens de erro--------------------->

        <div class="container-1">
            <h1 class="title-download">PRONTÚARIO</h1>

            <!---------------Dados do Paciente---------------->
            <button class="btn-blue" , id="action-btn3">Dados de Paciente</button>
            <div class="box-scheduling" , id="container-teste3">
                <div id="register">
                    <div class="row">
                        @if (isset($paciente))
                            <!----------Nome----------->
                            <div class="col-lg-12">
                                <label>Nome</label> <br>
                                <input disabled id="fnome" name="fnome" type="text" maxlength="50"
                                    value="{{ $paciente['nome'] }}" required>
                            </div>
                    </div>

                    <div class="row">
                     <!---------data de nascimento----------->
                        <div class="col-md-4 col-lg-4">
                            <label>Data de Nascimento</label> <br>
                            <input disabled id="fnascimento" name="fnascimento" type="date"
                                value="{{ $paciente['nascimento'] }}" required>
                        </div>
                         <!----------CPF----------->
                        <div class="col-md-4 col-lg-4">
                            <label>CPF</label> <br>
                            <input disabled id="fcpf" name="fcpf" type="text" required maxlength="14"
                                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{ $paciente['cpf'] }}">
                        </div>
                         <!----------Sexo----------->
                        <div class="col-md-4 col-lg-4">
                            <div class="sex-form">
                                <label>Sexo</label> <br>
                                @if ($paciente['sexo'] = 'M')
                                    <input class="radial-no-edit" id="MASCULINO" name="fsexo" value="Masculino"
                                        type="button">
                                @else
                                    <input class="radial-no-edit" id="FEMININO" name="fsexo" value="Feminino"
                                        type="button">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                     <!----------Tipo Sanguineo----------->
                        <div class="col-md-4 col-lg-4">
                            <label>Tipo Sanguineo</label> <br>
                            <input disabled id="fsanguineo" name="fsanguineo" type="text"
                                value="{{ $paciente['sangue'] }}" maxlength="50" required>
                        </div>
                         <!----------data de internação----------->
                        <div class="col-md-4 col-lg-4">
                            <label>Data de Internação</label> <br>
                            <input disabled id="fdatainternacao" name="fdatainternacao" type="date"
                                value="{{ $paciente['internacao'] }}" required>
                        </div>
                         <!----------Leito----------->
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                            <label>Leito</label> <br>
                            <input disabled id="fleito" name="fleito" type="text" maxlength="50"
                                value="{{ $paciente['leito'] }}" required>
                        </div>
                         <!----------Status----------->
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                            <label>Status</label> <br>
                            <input disabled id="fstatus" name="fstatus" id="fstatus" type="text" maxlength="50"
                                placeholder="alta, internado ou obito" value="{{ $paciente['estado'] }}" required>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!---------------fim de dados do Paciente---------------->

             <!----------Agendamentos de medicamentos------------>
                
            <button class="btn-blue" id="action-btn2">Agendamentos</button>
            <div id = "container-teste2">
                <h2 class="text-center">Agendamentos</h2><br>
                @for($i = 0;$i <= count($infosA); $i++)
                @if(isset($infosA['hora'.$i]))
                    <div class="box-scheduling">
                        <div class="row">
                            <!---------------------Hora--------------------->
                            <div class="col-6 col-sm-12 col-md-6 col-lg-2 text-center">
                                <div class="box-gray">
                                    <a>{{ $infosA['hora' . $i] }}</a>
                                </div>
                            </div>
                            <!---------------------Data--------------------->
                            <div class="col-6 col-sm-12 col-md-6 col-lg-2 text-center">
                                <div class="box-gray">
                                    <a>{{ $infosA['data' . $i] }}</a>
                                </div>
                            </div>
                            <!---------------------Nome do Medicamento--------------------->
                            <div class="col-12 col-sm-12 col-md-6 col-lg-5 text-center">
                                <div class="box-white scrolls">
                                    <a>{{$infosA['medicamento'.$i]}}</a>
                                </div>
                            </div>
                            <!---------------------Posologia--------------------->
                            <div class="col-12 col-sm-12 col-md-6 col-lg-3 text-center">
                                <div class="box-white">
                                    <a>{{$infosA['posologia'.$i]}} ml</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!----------Aplicador do medicamento----------->
                            <div class="col-12 col-md-12 col-sm-12 col-lg-12">
                            @if(isset($infosA['aplicador'.$i]))
                                <div class="box-blue"> 
                                    <a>Preparador: {{$infosA['aplicador'.$i]}}</a> 
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-12 col-md-3 col-lg-3">
                                @if(!isset($infosA['aplicador'.$i]))
                                    <form method="POST" action="/ACagendamentos">
                                    @csrf
                                        <input type="hidden" name="codA" value="{{$agendamentos}}"> 
                                        <button type="submit" class="btn-white">Ser preparador</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @endfor
            </div>
                 <!----------fim de Agendamentos de medicamentos------------>

                <!----------------Medicações ministradas----------------->
                <button class="btn-blue", id="action-btn">Medicações ministradas</button>
                    <div id = "container-teste">
                        <h2 class="text-center">Medicações ministradas</h2><br>
                        @for($j = 0;$j <= count($infosM);$j++)
                        @if(isset($infosM['hora'.$j]))
                        <div class="box-scheduling">
                            <div class="row">
                            <!---------------------Hora--------------------->
                                <div class="col-6 col-sm-12 col-md-6 col-lg-2 text-center">
                                    <div class="box-gray">
                                        {{ $infosM['hora' . $j] }}
                                    </div>
                                </div>
                                <!---------------------Data--------------------->
                                <div class="col-6 col-sm-12 col-md-6 col-lg-2 text-center">
                                    <div class="box-gray">
                                        {{ $infosM['data' . $j] }}
                                    </div>
                                </div>
                                 <!---------------------Nome do Medicamento--------------------->
                                <div class="col-12 col-sm-12 col-md-6 col-lg-5 text-center">
                                    <div class="box-white scrolls">
                                        {{ $infosM['medicamento' . $j] }}
                                    </div>
                                </div>
                                <!---------------------Posologia--------------------->
                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 text-center">
                                    <div class="box-white">
                                        {{ $infosM['posologia' . $j] }}
                                    </div>
                                </div>
                            </div>
                            <!----------Aplicador do medicamento----------->
                            <div class="row">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <p>Aplicador</p>
                                </div>
                                <div class="col-md-10 col-lg-7 col-xl-7">
                                    <div class="box-gray">
                                        {{$infosM['aplicador'.$j]}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endfor
                    </div>
                <!----------------fim de medicações ministradas----------------->

                <!------------------Ocorrências--------------->
                <button class="btn-blue" id="action-btn4">Ocorrências</button>
                <div class="box-scheduling" id="container-teste4">
                    <h2 class="text-center">Ocorrencias</h2><br>
                    <form action="/cadastroOcorr" method="POST" id="register">
                        @csrf
                        <!----------Tabela de ocorrencias------------>
                        @if(isset($infosO))
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Data</th>
                                        <th scope="col">Hora</th> 
                                        <th scope="col">Responsável</th>
                                        <th scope="col">Ocorrencia</th>
                                    </tr>
                                </thead>
                                @for($k = 0; $k <= count($infosO); $k++)
                                @if(isset($infosO['ocorrencia'.$k]))
                                <tbody>
                                    <tr>
                                        <td>{{$infosO['data'.$k]}}</td>
                                        <td>{{$infosO['hora'.$k]}}</td>
                                        <td>{{$infosO['aplicador'.$k]}}</td>
                                        <td>{{$infosO['ocorrencia'.$k]}}</td>
                                    </tr>
                                </tbody>
                                @endif
                                @endfor
                            </table>
                        </div>
                        @endif
                        <!----------Registro de nova ocorrencia------------>
                        <div class="col-lg-12">
                            <input type="hidden" name="prontuario" value="{{ $paciente['prontuario'] }}">
                            <label>Nova Ocorrencia</label> <br>
                            <input id="focorrencia" name="focorrencia" type="text" maxlength="100" required>
                            <div>
                                <button type="submit" class="btn-blue"> Adicionar </button>
                            </div>
                        </div>
                    </form>
                </div>
            <!------------------fim de ocorrências--------------->

            <!----------------CIDs do paciente---------------->
            <button class="btn-blue" , id="action-btn5">CIDs</button>
            
            <div id="container-teste5">
                <div class="box-scheduling">
                    <h2 class="text-center">CIDs</h2><br>
                    <form action="/cadastroCID" method="POST" id="register">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label>Nova CID</label> <br>
                                <input type="hidden" name="prontuario" value="{{$paciente['prontuario']}}">
                                <input id="fcid" name="fcid" type="text" maxlength="20"  placeholder="EX: A00.1" required>
                                </div>
                            <div class="col-lg-6 col-md-6">
                                <button  type="submit" class="btn-blue"> Adicionar </button>
                            </div>
                        </div>
                        <h3>CIDs do Paciente</h3>
                        <div class="box-scheduling">
                            <div class="row">
                                @while (isset($infosC['cid' . $l]))
                                    <div class="col-lg-2 col-md-4 col-sm-6 col-6 text-center">
                                        <div class="box-gray">
                                            CID: {{ $infosC['cid' . $l] }}
                                        </div>
                                        {{ $l++ }}
                                    </div>
                                @endwhile
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!----------------fim de CIDs do paciente---------------->

            <!-------------Encerramento do Prontuario-------------->
            @if($paciente['estado'] == 'internado')
            <button class="btn-blue" , id="action-btn6">Encerrar Prontuario</button>
            <div class="box-scheduling">
                <h2 class="text-center">Encerrar prontuário</h2><br>
                <form action="/finalizarProntuario" method="POST" id="register">
                    @csrf
                    <input type="hidden" name="prontuario" value="{{ $paciente['prontuario'] }}">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Data de Saída</label> <br>
                            <input id="fsaida" name="fsaida" type="date" required>
                        </div>
                        <div class="col-lg-4">
                            <label for="status_saida">Status para Fechamento</label> <br>
                            <select required name="status_saida" id="status_saida">
                            </select>
                        </div>
                    </div>
                    <!----------Com a finalização do Prontuario o responsável irá arquivar o mesmo, tornando assim ineditável.------------>
                    <div>
                        <button class="btn-blue"> Finalizar </button>
                    </div>

                </form>
            </div>
            @endif
            <!-------------fim de encerramento do Prontuario-------------->
        </div>
    </section>
</body>

</html>
