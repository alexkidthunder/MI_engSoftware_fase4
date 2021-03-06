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
    <script src="{{ 'js/mascara.min.js' }}"></script>
    <script src="{{ 'js/removerUsuario.js' }}"></script>

    <title>Remoção de funcionário</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
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

    <h1>REMOÇÃO DE FUNCIONÁRIOS</h1>
    <div class="container-1">
        <div class="box">
            <!-----------Busca de Paciente------------>
            <div id="search">
                <div class="content-center">
                    <h3>BUSCAR FUNCIONÁRIO</h3>
                    <form class="search-bar" action="/buscarUsuario" method="GET">
                        <input id="cpf_user" name="cpf_user" type="text" placeholder="Digite o CPF"
                            onkeyup="mascara('###.###.###-##',this,event,true)" required maxlength="14"
                            pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <!----------Fim da busca de paciente----------->


            <!--------- Mensagem de erro ao tentar se remover --------->
            @if (session('msg-error'))
                <div class='msg-error'> {{ session('msg-error') }}</div>

            @endif

            @if (isset($user))
                @if (!is_array($user))
                    @if ($user == 0)
                        <div class='msg-error'> O funcionário não foi encontrado. Verifique se o CPF informado está
                            correto. </div>
                    @endif
                @else
                    <!--------------Fim da mensagem de erro ----------------->

                    <!---------------------Infomações do Paciente---------------->
                    <h3>Funcionário</h3>
                    <div class="row">
                        <div class="col-xl">
                            <div name="user_field" class="box-gray scrolls">
                                <!--Campos de informações sobre o usuário buscado-->
                                <span>{{ $user['Nome'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div name="user_field" class="box-gray scrolls">
                                <span style="white-space: nowrap">CPF: {{ $user['CPF'] }}</span>
                            </div>
                        </div>
                        <!-- Se a atribuição for igual a zero é por que ele é do tipo Estagiário ou ADM,
                    logo não precisa exibir o COREN -->
                        @if ($atribuicao == 0)
                            <!-- Não exibe nada, pois não tem coren -->
                        @else
                            <div class="col-md-6 col-xl-4">
                                <div name="user_field" class="box-gray scrolls">
                                    <span style="white-space: nowrap">COREN: {{ $atribuicao['COREN'] }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-6 col-xl-4">
                            <div class="box-gray">
                                {{ $user['Atribuicao'] }}
                            </div>
                        </div>
                    </div>
                    <!---------------------fim Infomações do Paciente---------------->

                    <form action="/removerUsuario" method="GET">
                        <!--Form para deletar o usuário buscado-->
                        <input type="hidden" name="cpf" value="{{ $user['CPF'] }}">
                        <input type="hidden" name="atr" value="{{ $user['Atribuicao'] }}">
                        <div class="container-button" id="delete-user-container">
                            <button type="submit" class="btn-blue " data-toggle="modal" data-target="#delete"
                                id="remove-user-btn"> Remover </button>
                        </div>
                    </form>
                @endif
            @endif
            <!---------------------Mensagens--------------->
            @if (isset($status))
                @if ($status == 1)
                    <div class='msg-sucess'>O usuário foi removido com sucesso!</div>
                @else
                    <div class='msg-error'>A remoção não pôde ser concluida, tente novamente!</div>
                @endif
            @endif
            <!----------------fim de mensagens-------------->
        </div>

        <!-- Modal -->
        <div id="delete" class="modal">
            <div class="modal-dialog">
                <div class="confirmation-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja remover ....?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary">Cancelar</button>
                        <form>
                            <button type="button" class="btn btn-danger">Remover</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
