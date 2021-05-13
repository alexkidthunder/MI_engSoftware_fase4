<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ ('css/style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    
    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <script src="{{ ('js/permissao.js') }}" defer></script>
    
    <title>Permissões do usuário</title>
    
  </head>
  <body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->

    <h1>ALTERAR PERMISSÕES</h1>
        <div class="container-80" >
            <div class="box" id="permission">
                <!--Buscar funcionário-->
                <div class="content-center">
                    <h3>SELECIONAR TIPO DE CARGO</h3>
                    <form action="/editarPermissao" method="GET">                     

                        <select id="atribuicao" name="atribuicao" onchange="this.form.submit()">
                            <option value="admin">Administrador</option>
                            <option value="enfermeiroChefe">Enfermeiro chefe</option>
                            <option value="enfermeiro">Enfermeiro</option>
                            <option value="estagiario">Estagiário</option>
                        </select>
                    </form>
                </div>
                <br>

            <!---------------- Alterar permissões ---------------->
          {{-- <div class="box" id="permission">--}}
                    <form>
                        @csrf
                        <h3 id="Nome_Permissao" class="content-center">ESCOLHA UM CARGO</h3> <br>
                        <!-- ========== Linha 1 (REFERENTE AO ADM) ========== --> 
                        
                       
                        <div class="row">
                            <!--Inicio da permissão-->
                                                      
                            @if(isset($p[1]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p1"  {{ $p[1]}} > ><br>
                                <label>Cadastro de funcionário</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            
                              <!--Inicio da permissão-->
                              @if(isset($p[2]))
                              <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p2" {{ $p[2]}}><br>
                                <label>Remoção de funcionário</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[3]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p3" {{ $p[3]}}><br>
                                <label>Alterar atribuição do funcionário</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[4]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p4" {{ $p[4]}}><br>
                                <label>Editar permissões de cargo</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[5]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p5" {{ $p[5]}}><br>
                                <label>Visualizar permissões de cargo</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 1 ========== --> 

                        <!-- ========== Linha 2 ========== --> 
                        <div class="row">
                            @if(isset($p[6]))
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p6" {{ $p[6]}}><br> 
                                <label>Cadastro de plantonista</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[7]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p7" {{ $p[7]}}><br>
                                <label>Remoção de plantonista</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[8]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p8" {{ $p[8]}}><br>
                                <label>Cadastro de medicamentos</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[9]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p9" {{ $p[9]}}><br>
                                <label>Cadastro de CID</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[10]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p10" {{ $p[10]}}><br>
                                <label>Remoção de CID</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 2 ========== --> 

                        <!-- ========== Linha 3 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            @if(isset($p[11]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p11" {{ $p[11]}}><br>
                                <label>Cadastro de agendamento</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[12]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p12" {{ $p[12]}}><br>
                                <label>Alocar responsável por agendamento</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[13]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p13" {{ $p[13]}}><br>
                                <label>Listagem de plantonistas</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[14]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p14" {{ $p[14]}}><br>
                                <label>Listagem de agendamentos</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[15]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p15" {{ $p[15]}}><br>
                                <label>Responsáveis por aplicação de medicamentos</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 3 ========== --> 

                        <!-- ========== Linha 4 ========== --> 
                        <div class="row">
                            @if(isset($p[16]))
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p16" {{ $p[16]}}><br>
                                <label>Cadastro de pacientes</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[17]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p17" {{ $p[17]}}><br>
                                <label>Visualizar pacientes e prontuários</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[18]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p18" {{ $p[18]}}><br>
                                <label>Acesso ao prontuário do paciente</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[19]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p19" {{ $p[19]}}><br>
                                <label>Editar informações pessoais do paciente</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[20]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p20" {{ $p[20]}}><br>
                                <label>Listagem de medicamentos para preparação</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 4 ========== --> 

                        <!-- ========== Linha 5  ========== --> 
                        
                        <div class="row">
                            <!--Inicio da permissão-->
                            @if(isset($p[21]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p21" {{ $p[21]}}><br>
                                <label>Visualização de agendamento realizados pelo funcionário</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[22]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p22" {{ $p[22]}}><br>
                                <label>Visualização de agendamento alocados para o funcionário</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[23]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p23" {{ $p[23]}}><br>
                                <label>Aplicação de medicamentos</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[24]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p24" {{ $p[24]}}><br>
                                <label>Nomear-se responsável por preparar a aplicação</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[25]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p25" {{ $p[25]}}><br>
                                <label>Dar baixa no agendamento</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 5 ========== --> 

                        <!-- ========== Linha 6 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            @if(isset($p[26]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p26" {{ $p[26]}}><br>
                                <label>Visualizar ocorrências do paciente</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[27]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p27" {{ $p[27]}}><br>
                                <label>Registro de ocorrências</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[28]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p28" {{ $p[28]}}><br>
                                <label>Cadastro do leito</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[29]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p29" {{ $p[29]}}><br>
                                <label>Remoção do leito</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[30]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p30" {{ $p[30]}}><br>
                                <label>Realizar / Agendar Backup</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 6 ========== --> 

                        <!-- ========== fim da linha 7 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            @if(isset($p[31]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p31" {{ $p[31]}}><br>
                                <label>Inserir data de internação do paciente</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[32]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p32" {{ $p[32]}}><br>
                                <label>Inserir data de saída do paciente</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            @if(isset($p[33]))
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p33" {{ $p[33]}}><br>
                                <label>Alocar leito do paciente</label>
                            </div>
                            @endif
                            <!--Fim da permissão-->                        
                        </div>
                        <!-- ========== fim da linha 7 ========== -->   
   
                        <div>
                        
                            <button type="submit" class="container-button btn-white">Alterar</button>
                        </div>  
                    </form>
          {{--  </div> --}}
        </div>
  </body>
</html>