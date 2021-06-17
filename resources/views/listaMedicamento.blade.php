<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">
    {{$i = 0}}
    <title>Medicamentos cadastrados</title>
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
    <section>
    <div id="screen-icon">
        <form method="get" action="/baixarArquivos" class="download-icon">
            <button>
                <i class="fas fa-download"></i>
            </button>
            @if(isset($m))
            <input type="hidden" name="listagem" value="{{implode('|',$m)}}">
            <input type="hidden" name="tela" value="lm">
            @endif
        </form>
    </div>
    </section>
    <!--------Fim do botão de donwload-------->

    <div class="container-1" id="medicament-list">

        <h1 class="title-download">MEDICAMENTOS CADASTRADOS</h1>

        <!-------------- Medicamento  -------------->
        @for($i = 0;$i <= count($m); $i++)
        @if(isset($m["nome".$i]))
        <div class="box-white">
            <!----- Nome do medicamento----->
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Nome</label> <br>
                    <div class="box-blue scrolls">
                        {{$m["nome".$i]}}
                    </div>
                </div>
            </div>
            <div class="row">
                <!----- Data de validade do medicamento----->
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <label style="white-space: nowrap">Data de validade</label> <br>
                    <div class="box-gray">
                        {{$m["data".$i]}}
                    </div>
                </div>
                <!-----Quantidade do medicamento----->
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                    <label style="white-space: nowrap">Em estoque</label> <br>
                    <div class="box-gray">
                        {{$m["quantidade".$i]}}
                    </div>
                </div>
                <!-----Fabricante do medicamento----->
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <label>Fabricante</label> <br>
                    <div class="box-gray scrolls">
                        {{$m["fabricante".$i]}}
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endfor
        <!-------------- Fim do medicamento  -------------->
    </div>
</body>

</html>
