var preparador = document.getElementsByName('preparador_div');
var add_preparador = document.getElementById('add_prep_btn');
var concluir_preparador = document.getElementById('end_prep_div');
var nome_preparador = document.getElementById('preparador');
var finalizar_prep = document.getElementById('end_prep_btn');

add_preparador.addEventListener('click',function(){
    console.log('click funcionou');
    preparador.forEach(Element =>{
        if(Element.classList.contains('hide')){
            console.log('chegou aqui');
            Element.classList.remove('hide');
        }
    })
    if(concluir_preparador.classList.contains('hide')){
        concluir_preparador.classList.remove('hide');
    }
    else if(!this.classList.contains('hide')){
        var text = document.createTextNode("José Marcos"); /* exemplo */
        var p_div = document.createElement('p');
        p_div.id = "Nome_do_Preparador";
        p_div.appendChild(text);
        nome_preparador.appendChild(p_div);
        this.classList.add('hide');
    }
})

finalizar_prep.addEventListener('click',function(){
    if(add_preparador.classList.contains('hide')){
        this.classList.add('hide');
    }
})
