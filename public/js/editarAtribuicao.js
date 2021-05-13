/* Campo onde fica o dado da atribuição atual do usuário buscado */
var atribuiçãoAtual = document.getElementById('atribuicaoAtual');

/* Select onde fica as opções para alterar as atribuições */
var selectMudanca = document.getElementById('novaAtribuicao');
var searchBtn = document.getElementById('busca_user');

/* Criando options de valor Enfermeiro para um Select */
var Enfermeiro = document.createElement('option');
var EnfermeiroText = document.createTextNode('Enfermeiro');
Enfermeiro.appendChild(EnfermeiroText);
Enfermeiro.setAttribute("value","Enfermeiro");

/* Criando options de valor Enfermeiro Chefe para um Select */
var EnfermeiroChefe = document.createElement('option');
var EnfermeiroChefeText = document.createTextNode('Enfermeiro Chefe');
EnfermeiroChefe.appendChild(EnfermeiroChefeText);
EnfermeiroChefe.setAttribute("value","Enfermeiro Chefe");

/* Criando options de valor Estagiario para um Select */
var Estagiario = document.createElement('option');
var EstagiarioText = document.createTextNode('Estagiário');
Estagiario.appendChild(EstagiarioText);
Estagiario.setAttribute("value","Estagiario");

/* Criando options de valor Administrador para um Select */
var Administrador = document.createElement('option');
var AdministradorText = document.createTextNode('Administrador');
Administrador.appendChild(AdministradorText);
Administrador.setAttribute("value","Administrador");

var CorenDiv = document.getElementById('corenDiv');
var CorenInpt = document.getElementById('fcoren');
    
    atualizarSelect();
    setSelectByCargo();

selectMudanca.addEventListener("change",function(){
    atualizarSelect();
    
})

function atualizarSelect(){
    console.log('foi');
    if(atribuiçãoAtual.innerHTML === "Estagiario"){
        if(selectMudanca.value === "Enfermeiro Chefe" || selectMudanca.value === "Enfermeiro"){ 
            CorenDiv.classList.remove('hide');
            if(CorenInpt.hasAttribute("required") === false){
                CorenInpt.setAttribute("required","");
            }
            console.log('foi aqui');
        }
        else{
            CorenDiv.classList.add('hide');
            if(CorenInpt.hasAttribute("required")){
                CorenInpt.removeAttribute("required");
            }
            console.log('foi aqui 2');
        }
    }
}
function resetSelect(){
    var i = selectMudanca.length;
    do{
        selectMudanca.remove(0);
        i --;
    }while(i > 0);
}
function setSelectByCargo(){
    
    resetSelect();
    if(atribuiçãoAtual.innerHTML === "Enfermeiro Chefe" || atribuiçãoAtual.innerHTML === "Enfermeiro"){

        selectMudanca.appendChild(EnfermeiroChefe);
        selectMudanca.appendChild(Enfermeiro);
        //corenUserData.style.display = "";
        if(atribuiçãoAtual.innerHTML === "Enfermeiro Chefe"){
            selectMudanca.value = "Enfermeiro Chefe";
        }
        else{
            selectMudanca.value = "Enfermeiro";
        }
        
    }else if(atribuiçãoAtual.innerHTML === "Administrador"){
        resetSelect();
        selectMudanca.appendChild(Administrador);
    }
     else{

        selectMudanca.appendChild(EnfermeiroChefe);
        selectMudanca.appendChild(Enfermeiro);
        selectMudanca.appendChild(Estagiario);
        selectMudanca.value = "Estagiario";
    }
}