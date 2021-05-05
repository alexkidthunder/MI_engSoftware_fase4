<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="{{ 'css/style.css' }}" rel="stylesheet">
    <link href="{{ 'bootstrap/css/bootstrap.css' }}" rel="stylesheet">

</head>

<body>



    <!-- Confirmação para remorção -->
    <div id="delete">
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


    <!-- Confirmação -->
    <div id="confirmation">
        <div class="modal-dialog">
            <div class="confirmation-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Mensagem de confirmação ....?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Cancelar</button>
                    <form>
                        <button type="button" class="btn btn-success">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="msg-sucess">
        MENSAGEM DE SUCESSO
    </div>

    <div class="msg-error">
        MENSAGEM DE ERRO
    </div>

</body>

</html>
