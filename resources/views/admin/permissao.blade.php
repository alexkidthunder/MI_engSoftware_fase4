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
        <div class="container-80">
            <div class="box">
                <!--Buscar funcionário-->
                <div class="content-center">
                    <h3>SELECIONAR TIPO DE CARGO</h3>
                    <form>
                        @csrf
                        <select id="atribuicao" name="atribuicao">
                            <option value="admin">Administrador</option>
                            <option value="enfermeiroChefe">Enfermeiro chefe</option>
                            <option value="enfermeiro">Enfermeiro</option>
                            <option value="estagiario">Estagiário</option>
                        </select>
                    </form>
                </div>

            <!---------------- Alterar permissões ---------------->
            <div class="box" id="permission">
                    <form>
                        @csrf
                        <h3 class="content-center">PERMISSÕES DO "inserir o valor selecionado" </h3> <br>
                        <!-- ========== Linha 1 (REFERENTE AO ADM) ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Cadastro de funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Remoção de funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Alterar atribuição do funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Editar permissões de cargo</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Visualizar permissões de cargo</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 1 ========== --> 

                        <!-- ========== Linha 2 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Cadastro de plantonista</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Remoção de plantonista</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Cadastro de medicamentos</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Cadastro de CID</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Remoção de CID</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 2 ========== --> 

                        <!-- ========== Linha 3 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Cadastro de agendamento</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Alocar responsável por agendamento</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Listagem de plantonistas</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Listagem de agendamentos</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Responsáveis por aplicação de medicamentos</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 3 ========== --> 

                        <!-- ========== Linha 4 ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Cadastro de pacientes</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Visualizar pacientes e prontuários</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Acesso ao prontuário do paciente</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Editar informações pessoais do paciente</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Listagem de medicamentos para preparação</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha 4 ========== --> 

                        <!-- ========== Linha  ========== --> 
                        <div class="row">
                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Visualização de agendamento realizados pelo funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Visualização de agendamento alocados para o funcionário</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Aplicação de medicamentos</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Nomear-se responsável por preparar a aplicação</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Dar baixa no agendamento</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Visualizar ocorrências do paciente</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Registro de ocorrências</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Cadastro do leito</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Remoção do leito</label>
                            </div>
                            <!--Fim da permissão-->

                            <!--Inicio da permissão-->
                            <div class="col-lg-13 content-center">
                                <input type="checkbox"><br>
                                <label>Realizar / Agendar Backup</label>
                            </div>
                            <!--Fim da permissão-->
                        </div>
                        <!-- ========== fim da linha ========== --> 

                        <div>
                            <button type="submit" class="container-button btn-white">Alterar</button>
                        </div>  
                    </form>
            </div>
        </div>
  </body>
