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
   
    <h1>PRONTÚARIO</h1>
    <section>
        
        <div class="container-1"> 
            
        <button class="btn-blue", id="action-btn3">Dados de Paciente</button>
            <div class="box-scheduling", id= "container-teste3">
                <form id="register">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Nome</label> <br>
                            <input id="fnome" name="fnome" type="text" maxlength="50" value="Nome do paciente" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <label>Data de Nascimento</label> <br>
                            <input id="fnascimento" name="fnascimento" type="date" required>
                        </div>
                        <div class="col-lg-4">
                            <label>CPF</label> <br>
                            <input id="fcpf" name="fcpf" type="text" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" value="055.312.452.12">
                        </div>
                        <div class="col-lg-4">
                            <div class="sex-form">
                                <label>Sexo</label> <br>
                                <input id="MASCULINO" name="fsexo" value="Masculino" type="button">
                                <input id="FEMININO" name="fsexo" value="Feminino" type="button">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">
                            <label>Tipo Sanguineo</label> <br>
                            <input id="fsanguineo" name="fsanguineo" type="text" value="AB-" maxlength="50" required >
                        </div>
                        <div class="col-lg-4">
                            <label>Data de Internação</label> <br>
                            <input id="fdatainternacao" name="fdatainternacao" type="date" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Leito</label> <br>
                            <input id="fleito" name="fleito" type="text" maxlength="50" value="A26" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Status</label> <br>
                            <input id="fstatus" name="fstatus" type="text" maxlength="50" value = "estavel" required>
                        </div>
                    </div>
                    
                    <div>
                        <button class="btn-blue"> Editar </button>
                    </div>
                </form>
            </div>
                <button class="btn-blue", id="action-btn2">Mostrar Agendamento</button>
                    <div class="box-scheduling" id = "container-teste2">
                    <div class="container-box">
                        <div class="row">
                            <div class="col-lg-2 text-center">
                                <div class="box-gray">
                                    <a>xx:xx</a>
                                </div>
                            </div>
                            <div class="col-lg-2 text-center">
                                <div class="box-gray">
                                    <a>xx/xx/xx</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="box-white">
                                    <a>Nome do Medicamento Aqui</a>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="box-white">
                                    <a>Posologia</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="box-blue">
                                    <a>Nome do Paciente Aqui</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="box-blue">
                                    <a>Leito: Código</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9"> <!--isso aqui fica hidden--->
                                <div class="box-blue"> 
                                    <a>Nome do Preparador Aqui</a> 
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div>
                                    <input type="button" id="add_prep" value="Adicionar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn-blue", id="action-btn">Mostrar Medicações Ministradas</button>
                <div class="box-scheduling", id = "container-teste">
                    <div class="row">
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                22:30h
                             </div>
                        </div>
                        <div class="col-lg-2 text-center">
                            <div class="box-gray">
                                20/04/2021
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box-white">
                            Dipirona
                             </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="box-white">
                                0.35 ml
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9">
                            <button class="btn-Patient text-left">Samara Anjos de Oliveira</button>
                        </div>
                        <div class="col-lg-3">
                            <div class="box-blue">
                                Leito: AB04
                            </div>
                        </div>
                    </div>
                </div>    

                <button class="btn-blue", id="action-btn4">Ocorrencias</button>
            <div class="box-scheduling", id= "container-teste4">
                <form id="register">
                    <div class="row">
                        
                        <h3>Tabela de ocorrencias</h3>
                    </div>  
                            
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Data/Hora</th>
                                <th scope="col">Responsável</th>
                                <th scope="col">Ocorrencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>14/03/21 - 15:03</td>
                                <td>Julia Maria Souza</td>
                                <td>Vomitou muito</td>
                            </tr>
                            <tr>
                                <td>14/03/21 - 15:02</td>
                                <td>Rubens Carvalho</td>
                                <td>Infarto</td>
                            </tr>
                            <tr>
                                <td>14/03/21 - 15:00</td>
                                <td>Daniel Masvidal Covas</td>
                                <td>Pressão alta</td>
                            </tr>
                            <tr>
                                <td>13/03/21 - 12:30</td>
                                <td>Vinícius Maciel</td>
                                <td>Fortes dores na lombar</td>
                            </tr>
                        </tbody>
                    </table>

                        <div class="col-lg-12">
                            <label>Nova Ocorrencia</label> <br>
                            <input id="focorrencia" name="focorrencia" type="text" maxlength="100" required>
                                <div>
                                <button class="btn-blue"> Adcionar </button>
                                </div>
                        </div>
                    
                </form>
            </div>
            
            <button class="btn-blue", id="action-btn5">CIDs</button>
            <div class="box-scheduling", id= "container-teste5">
                <form id="register">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Nova CID</label> <br>
                            <input id="fcid" name="fcid" type="text" maxlength="20" required>
                                <div>
                                <button class="btn-blue"> Adcionar </button>
                                </div>
                        </div>
                    </div>  
                    <h3>CIDs do Paciente</h3>
                        <div class="box-scheduling">
                            <div class="row">
                                <div class="col-lg-2 text-center">
                                    <div class="box-gray">
                                        CID: 223
                                    </div>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <div class="box-gray">
                                        CID: 112
                                    </div>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <div class="box-gray">
                                        CID: 146
                                    </div>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <div class="box-gray">
                                        CID: 199
                                    </div>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <div class="box-gray">
                                        CID: 126
                                    </div>
                                </div>
                            </div>   
                        </div>                 
                </form>
            </div>

            <button class="btn-blue", id="action-btn6">Encerrar Prontuario</button>
            <div class="box-scheduling", id= "container-teste6">
                <form id="register">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Data de Saída</label> <br>
                            <input id="fsaida" name="fsaida" type="date" required>
                        </div>   
                    </div>  
                        <div>
                            <button class="btn-blue"> Finalizar </button>
                        </div>
                                     
                </form>
            </div>
        </div>
    </section>
</body>
</html>