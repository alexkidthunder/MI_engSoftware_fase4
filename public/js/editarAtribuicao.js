var atribuiçãoAtual = document.getElementById('atribuicaoAtual');
var selectMudanca = document.getElementById('novaAtribuicao');
var searchBtn = document.getElementById('busca_user');


var Enfermeiro = document.createElement('option');
var EnfermeiroText = document.createTextNode('Enfermeiro');
Enfermeiro.appendChild(EnfermeiroText);
Enfermeiro.setAttribute("value","Enfermeiro");

var EnfermeiroChefe = document.createElement('option');
var EnfermeiroChefeText = document.createTextNode('Enfermeiro Chefe');
EnfermeiroChefe.appendChild(EnfermeiroChefeText);
EnfermeiroChefe.setAttribute("value","Enfermeiro Chefe");

var Estagiario = document.createElement('option');
var EstagiarioText = document.createTextNode('Estagiário');
Estagiario.appendChild(EstagiarioText);
Estagiario.setAttribute("value","Estagiário");

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

function setSelectByCargo(){
    var i = selectMudanca.length;
    do{
        selectMudanca.remove(0);
        i --;
    }while(i > 0);

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
        selectMudanca.classList.add('hide');
    }
     else{

        selectMudanca.appendChild(EnfermeiroChefe);
        selectMudanca.appendChild(Enfermeiro);
        selectMudanca.appendChild(Estagiario);
      //  corenUserData.classList.add('hide');
        selectMudanca.value = "Estagiário";
    }
}