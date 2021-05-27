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
    <script src="{{ ('js/mascara.min.js')}}"></script>

    <title>Remoção de funcionário</title>
</head>

<body>
    <!----------Hearder------------>
    @include('layouts.navbar-adm')
    <!----------End Hearder-------->

    <h1>REMOÇÃO DE FUNCIONÁRIOS</h1>
    <div class="container-1">
        <div class="box">
            <!--Buscar funcionário-->
            <div id="search">
                <div class="content-center"> <!--Área onde se busca um funcionário-->
                    <h3>BUSCAR FUNCIONÁRIO</h3>
                    <form class="search-bar" action="/buscarUsuario" method="GET">
                    <input id="cpf_user" name="cpf_user" type="text" placeholder= "Digite o CPF" onkeyup="mascara('###.###.###-##',this,event,true)" 
                            required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div> <!--Fim da área onde se busca um funcionário-->

            <!--Infomações do funcionário funcionário-->
            @if(isset($user))
            @if(!is_array($user))
            @if($user == 0)
            <div class='msg-error'> O usuário não foi encontrado</div>
            @endif
            @else


            <h3>Funcionário</h3>
            <div class="box-gray"> <!--Campos de informações sobre o usuário buscado-->
                {{$user['Nome']}}
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="box-gray">
                        CPF: {{$user['CPF']}}
                    </div>
                </div>
                <!-- Se a atribuição for igual a zero é por que ele é do tipo Estagiário ou ADM,
                    logo não precisa exibir o COREN -->
                @if($atribuicao == 0)
                <!-- Não exibe nada, pois não tem coren -->
                @else
                <div class="col-lg-4">
                    <div class="box-gray">
                        COREN: {{$atribuicao['COREN']}}
                    </div>
                </div>
                @endif

                <div class="col-lg-4">
                    <div class="box-gray">
                        {{$user['Atribuicao']}}
                    </div>
                </div>
            </div> <!--Fim dos campos de informações sobre o usuário-->
                <form action="/removerUsuario" method="GET"> <!--Form para deletar o usuário buscado-->
                    <input type="hidden" name="cpf" value="{{$user['CPF']}}">
                    <input type="hidden" name="atr" value="{{$user['Atribuicao']}}">
                    <button type="submit" class="container-button btn-blue " data-toggle="modal" data-target="#delete"> Remover </button>
                </form>
                @endif
                @endif
                <!--  -->
                @if(isset($status))
                @if($status == 1)
                <div class='msg-sucess'>O usuário foi removido com sucesso!</div>
                @else
                <div class='msg-error'>A remoção não pôde ser concluida, tente novamente!</div>
                @endif
                @endif
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