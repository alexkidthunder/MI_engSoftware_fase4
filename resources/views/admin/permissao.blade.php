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
                    <form>
<<<<<<< Updated upstream
                        <select id="atribuicao" name="atribuicao">
=======
                        @csrf
                        <select id="atribuicao" name="atribuicao" onchange="this.form.submit()">
>>>>>>> Stashed changes
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
                        <h3 class="content-center">PERMISSÕES DO "inserir o valor selecionado" </h3> <br>
                        <!-- ========== Linha 1 (REFERENTE AO ADM) ========== --> 
                        @if(isset($p))
                        <div class="row">
                            <!--Inicio da permissão-->
                                                      
                            
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p1"  {{ $p[1]}} > ><br>
                                <label>Cadastro de funcionário</label>
                            </div>
                            
                            <!--Fim da permissão-->

                            
                              <!--Inicio da permissão-->
                              <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p2" {{ $p[2]}}><br>
                                <label>Remoção de funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p3" {{ $p[3]}}><br>
                                <label>Alterar atribuição do funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p4" {{ $p[4]}}><br>
                                <label>Editar permissões de cargo</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p5" {{ $p[5]}}><br>
                                <label>Visualizar permissões de cargo</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 1 ========== --> 

                        <!-- ========== Linha 2 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p6" {{ $p[6]}}><br> 
                                <label>Cadastro de plantonista</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p7" {{ $p[7]}}><br>
                                <label>Remoção de plantonista</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p8" {{ $p[8]}}><br>
                                <label>Cadastro de medicamentos</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p9" {{ $p[9]}}><br>
                                <label>Cadastro de CID</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p10" {{ $p[10]}}><br>
                                <label>Remoção de CID</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 2 ========== --> 

                        <!-- ========== Linha 3 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p11" {{ $p[11]}}><br>
                                <label>Cadastro de agendamento</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p12" {{ $p[12]}}><br>
                                <label>Alocar responsável por agendamento</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p13" {{ $p[13]}}><br>
                                <label>Listagem de plantonistas</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p14" {{ $p[14]}}><br>
                                <label>Listagem de agendamentos</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p15" {{ $p[15]}}><br>
                                <label>Responsáveis por aplicação de medicamentos</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 3 ========== --> 

                        <!-- ========== Linha 4 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p16" {{ $p[16]}}><br>
                                <label>Cadastro de pacientes</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p17" {{ $p[17]}}><br>
                                <label>Visualizar pacientes e prontuários</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p18" {{ $p[18]}}><br>
                                <label>Acesso ao prontuário do paciente</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p19" {{ $p[19]}}><br>
                                <label>Editar informações pessoais do paciente</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p20" {{ $p[20]}}><br>
                                <label>Listagem de medicamentos para preparação</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 4 ========== --> 

                        <!-- ========== Linha 5  ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p21" {{ $p[21]}}><br>
                                <label>Visualização de agendamento realizados pelo funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p22" {{ $p[22]}}><br>
                                <label>Visualização de agendamento alocados para o funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p23" {{ $p[23]}}><br>
                                <label>Aplicação de medicamentos</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p24" {{ $p[24]}}><br>
                                <label>Nomear-se responsável por preparar a aplicação</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p25" {{ $p[25]}}><br>
                                <label>Dar baixa no agendamento</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 5 ========== --> 

                        <!-- ========== Linha 6 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p26" $p><br>
                                <label>Visualizar ocorrências do paciente</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p27" $p><br>
                                <label>Registro de ocorrências</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p28" $p><br>
                                <label>Cadastro do leito</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p29" $p><br>
                                <label>Remoção do leito</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p30" $p><br>
                                <label>Realizar / Agendar Backup</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 6 ========== --> 

                        <!-- ========== fim da linha 7 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox" name="p31" $p><br>
                                <label>Inserir data de internação do paciente</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
<<<<<<< Updated upstream
                                <input type="checkbox"><br>
=======
                                <input type="checkbox" name="p32" $p><br>
>>>>>>> Stashed changes
                                <label>Inserir data de internação do paciente</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 7 ========== -->   
                        @endif
                        <div>
                        
                            <button type="submit" class="container-button btn-white">Alterar</button>
                        </div>  
                    </form>
          {{--  </div> --}}
        </div>
  </body>
