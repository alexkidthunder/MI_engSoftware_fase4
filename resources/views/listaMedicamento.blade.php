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
        @while(isset($m["nome".$i]))
        <div class="box-white">
            <!----- Nome do medicamento----->
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <label>Nome</label> <br>
                    <div class="box-blue">
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
                    <div class="box-gray">
                        {{$m["fabricante".$i]}}
                    </div>
                </div>
            </div>
            {{$i = $i +1}}
        </div>
        @endwhile
        <!-------------- Fim do medicamento  -------------->
    </div>
</body>

</html>
