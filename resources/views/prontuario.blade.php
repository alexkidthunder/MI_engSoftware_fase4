<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
    <script src= "js/scriptprontuario.js" defer></script>

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    {{$i = 0}}
    {{$j = 0}}
    {{$k = 0}}
    {{$l = 0}}
    <title>PRONTÚARIO</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar')
    <!----------End Hearder-------->

    <div id="screen-icon"> <!-- Icone de Download Em Telas -->
        <form class="download-icon">
            <button>
                <i class="fas fa-download"></i>
            </button>
        </form>
    </div>
      <!----------Criação de Prontuario------------>
    
      <h1 class="title-download">PRONTÚARIO</h1>
    <section>
    <div class="row">
            <div class="col-lg">
                @if ($errors->any()) <!--Verificando se existe qualquer erro -->
                    <div class="msg-error">
                        <ul>
                            @foreach ($errors->all() as $error) <!--Percorre todos os erros-->
                                <li>{{ $error }}</li> <!--Obtem o erro -->
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('msg')) <!-- Verifica se a mensagem de erro foi instanciada -->
                    <div class="msg-sucess">
                        {{session('msg')}} <!--Obtem mensagem de erro -->
                    </div>
                @endif
                @if (session('msg-error')) <!-- Verifica se a mensagem de erro foi instanciada -->
                    <div class="msg-error">
                        {{session('msg-error')}} <!--Obtem mensagem de erro -->
                    </div>
                @endif
            </div>
        </div>
        
        <div class="container-1"> 
               <!----------Primeira parte do Prontuario, onde fica localizado os dados do Paciente------------>
        <button class="btn-blue", id="action-btn3">Dados de Paciente</button>
            <div class="box-scheduling", id= "container-teste3">
                <div id="register">
                    <div class="row">
                    @if(isset($paciente))
                    <!----------Dados do Paciente------------>
                        <div class="col-lg-12">
                            <label>Nome</label> <br>
                            <input disabled id="fnome" name="fnome" type="text" maxlength="50" value="{{$paciente['nome']}}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <label>Data de Nascimento</label> <br>
                            <input disabled id="fnascimento" name="fnascimento" type="date" value= "{{$paciente['nascimento']}}" required>
                        </div>
                        <div class="col-lg-4">
                            <label>CPF</label> <br>
                            <input disabled id="fcpf" name="fcpf" type="text" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="{{$paciente['cpf']}}">
                        </div>
                        <div class="col-lg-4">
                            <div class="sex-form">
                                <label>Sexo</label> <br>
                                @if($paciente['sexo'] = 'M')
                                <input class="radial-no-edit" id="MASCULINO" name="fsexo" value="Masculino" type="button">
                                @else
                                <input class="radial-no-edit" id="FEMININO" name="fsexo" value="Feminino" type="button">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <label>Tipo Sanguineo</label> <br>
                            <input disabled id="fsanguineo" name="fsanguineo" type="text" value="{{$paciente['sangue']}}" maxlength="50" required >
                        </div>
                        <div class="col-lg-4">
                            <label>Data de Internação</label> <br>
                            <input disabled id="fdatainternacao" name="fdatainternacao" type="date" value= "{{$paciente['internacao']}}" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Leito</label> <br>
                            <input disabled id="fleito" name="fleito" type="text" maxlength="50" value="{{$paciente['leito']}}" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Status</label> <br>
                            <input disabled id="fstatus" name="fstatus" id="fstatus" type="text" maxlength="50" placeholder="alta, internado ou obito" value = "{{$paciente['estado']}}" required>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
                <!----------Segunda parte de Prontuario, onde vai ter a ala de Agendamentos daquele Prontuario------------>
                
                <button class="btn-blue", id="action-btn2">Mostrar Agendamento</button>
                    <div class="box-scheduling" id = "container-teste2">
                    @while(isset($infosA['hora'.$i]))
                    <div class="container-box">
                        <div class="row">
                            <div class="col-lg-2 text-center">
                                <div class="box-gray">
                                    <a>{{$infosA['hora'.$i]}}</a>
                                </div>
                            </div>
                            <div class="col-lg-2 text-center">
                                <div class="box-gray">
                                    <a>{{$infosA['data'.$i]}}</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="box-white">
                                    <a>{{$infosA['medicamento'.$i]}}</a>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="box-white">
                                    <a>{{$infosA['posologia'.$i]}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="box-blue">
                                    <a>{{$paciente['nome']}}</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="box-blue">
                                    <a>Leito: {{$paciente['leito']}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9"> <!--isso aqui fica hidden--->
                                <div class="box-blue"> 
                                    <a>Luiz Marcelo da Silva</a> 
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div>
                                    <input type="button" id="add_prep" value="Adicionar">
                                </div>
                            </div>
                        </div>
                        {{$i++}}
                    </div>
                    @endwhile
                </div>
                <!----------Terceira parte do Prontuario, onde fica localizada medicações ministradas------------>
                <button class="btn-blue", id="action-btn">Mostrar Medicações Ministradas</button>
                <div class="box-scheduling", id = "container-teste">
                    @while(isset($infosM['hora'.$j]))
                    <div class="row">
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                {{$infosM['hora'.$j]}}
                             </div>
                        </div>
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                {{$infosM['data'.$j]}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-white">
                            {{$infosM['medicamento'.$j]}}
                             </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="box-white">
                            {{$infosM['posologia'.$j]}}
                            </div>
                        </div>
                    </div>
                    <!----------Parte onde fica o nome do Aplicador do medicamento e o leito do paciente------------>
                    <div class="row">

                        <div class="col-lg-3">
                            <div class="box-blue">
                                Leito: {{$paciente['leito']}}
                            </div>
                        </div>
                    </div>
                    {{$j++}}
                    @endwhile
                </div>    
                <!----------Quarta parte do Prontuario, onde fica localizada as ocorrências------------>
                <button class="btn-blue", id="action-btn4">Ocorrencias</button>
            <div class="box-scheduling", id= "container-teste4">
                <form action="/cadastroOcorr" method="POST" id="register">
                @csrf
                    <div class="row">
                        
                        <h3>Tabela de ocorrencias</h3>
                    </div>  
                            <!----------Tabela de ocorrencias para ajudar na visualização do quadro do paciente------------>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Data/Hora</th>
                                    <th scope="col">Responsável</th>
                                    <th scope="col">Ocorrencia</th>
                                </tr>
                            </thead>
                            @while(isset($infosO['ocorrencia'.$k]))
                            <tbody>
                                <tr>
                                    <td>{{$infosO['data'.$k]}} - {{$infosO['hora'.$k]}}</td>
                                    <td>{{$infosO['aplicador'.$k]}}</td>
                                    <td>{{$infosO['ocorrencia'.$k]}}</td>
                                    <td>{{$k++}}</td>
                                </tr>
                            </tbody>
                            @endwhile
                        </table>
                    </div>
                    <!----------Onde o enfermeiro ou enfermeiro chefe colocara sua nova ocorrencia------------>
                    <div class="col-lg-12">
                        <input type="hidden" name="prontuario" value="{{$paciente['prontuario']}}">
                        <label>Nova Ocorrencia</label> <br>
                        <input id="focorrencia" name="focorrencia" type="text" maxlength="100" required>
                        <div>
                            <button type="submit" class="btn-blue"> Adcionar </button>
                        </div>
                    </div>      
                </form>
            </div>
            <!----------Quinta parte do Prontuario, onde fica localizado as CIDs do paciente------------>
            <button class="btn-blue", id="action-btn5">CIDs</button>
            <div class="box-scheduling", id= "container-teste5">
                <form action="/cadastroCID" method="POST" id="register">
                @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Nova CID</label> <br>
                            <input type="hidden" name="prontuario" value="{{$paciente['prontuario']}}">
                            <input id="fcid" name="fcid" type="text" maxlength="20"  placeholder="EX: A00.1" required>
                                <div>
                                <button  type="submit" class="btn-blue"> Adcionar </button>
                                </div>
                        </div>
                    </div>  
                    <h3>CIDs do Paciente</h3>
                        <div class="box-scheduling">
                            <div class="row">
                                @while(isset($infosC['cid'.$l]))
                                <div class="col-lg-2 text-center">
                                    <div class="box-gray">
                                        CID: {{$infosC['cid'.$l]}}
                                    </div>
                                    {{$l++}}
                                </div>
                                @endwhile
                            </div>   
                        </div>                 
                </form>
            </div>
            <!----------Ultima parte do Prontuario, onde o responsável podera encerrar o Prontuario------------>
            <button class="btn-blue", id="action-btn6">Encerrar Prontuario</button>
            <div class="box-scheduling", id= "container-teste6">
                <form action="/finalizarProntuario" method="POST" id="register">
                @csrf
                <input type="hidden" name="prontuario" value="{{$paciente['prontuario']}}">
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
        </div>
    </section>
</body>
</html>