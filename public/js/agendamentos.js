/**
 * Div do preparador do agendamento
 */
var preparador = document.getElementsByName('preparador_div');
/**
 * Botão para adicionar um preparador
 */
var add_preparador = document.getElementById('add_prep_btn');
/**
 * Div para finalizar a seleção de um preparador
 */
var concluir_preparador = document.getElementById('end_prep_div');
/**
 * Nome do preparador
 */
var nome_preparador = document.getElementById('preparador');
/**
 * Botão para finalizar a seleção de um preparador
 */
var finalizar_prep = document.getElementById('end_prep_btn');

add_preparador.addEventListener('click',function(){
    /*Deixa todas as div de nome "preparador_div" visíveis*/
    preparador.forEach(Element =>{
        if(Element.classList.contains('hide')){
            Element.classList.remove('hide');
        }
    })
    /*Se a div de finalizar a escolha de um preparador estiver invisível, mostre-a*/
    if(concluir_preparador.classList.contains('hide')){
        concluir_preparador.classList.remove('hide');
    }
    /*Se o botão de adiciona preparador está visível*/
    else if(!this.classList.contains('hide')){
        var text = document.createTextNode("José Marcos"); /* exemplo */
        var p_div = document.createElement('p');
        p_div.id = "Nome_do_Preparador";
        p_div.appendChild(text);
        nome_preparador.appendChild(p_div);
        this.classList.add('hide');
    }
})
/*Após clicar no botão para finalizar aplicação, esconda-o*/
finalizar_prep.addEventListener('click',function(){
    if(add_preparador.classList.contains('hide')){
        this.classList.add('hide');
    }
})
