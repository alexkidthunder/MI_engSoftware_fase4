<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('img/favicon.png') }}" rel="icon">
        <title>PDF_Download</title>
        <link href="{{ 'css/download-style.css' }}" rel="stylesheet">
        
    </head>
    <body>
        <header class="container-personal-data">
            <div>
                <h2>Nome Hospital</h2> <!--Nome do nosso Hospital-->
            </div>
            <div>
                <h2>Nome / CPF</h2> <!--Nome e CPF de quem requisitou o download-->
            </div>
            <div>
                <h2>00:00 - 00/00/00</h2> <!--Data e Hora em que foi feito o download-->
            </div>
        </header>
        <hr>
        <section>
            <div class="container-header"> 
                <h1>Pacientes e Prontuários</h1> <!--De onde saiu a lista-->
            </div>
            <hr>
            <div class="container-listagem">
                <div>
                    <h2>Listagem 1 Exemplo</h2> <!--Nome da Listagem--> <!--Se precisar ser mais específico-->
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Maria de Fátima Cerqueira Santana Silva</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Internada</p>
                    </div>
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Pedro Paulo Matos</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Óbito</p>
                    </div>
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Fernando Alex Costa Moreira</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Liberado</p>
                    </div>
                </div>
            </div>
            <div class="container-listagem">
                <div>
                    <h2>Listagem 2 Exemplo</h2> <!--Nome da Listagem--> <!--Se precisar ser mais específico-->
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Maria de Fátima Cerqueira Santana Silva</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Internada</p>
                    </div>
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Pedro Paulo Matos</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Óbito</p>
                    </div>
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Fernando Alex Costa Moreira</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Liberado</p>
                    </div>
                </div>
            </div>
        </section>
        <footer style="position: absolute; bottom: 0;">
            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
        </footer>
    </body>