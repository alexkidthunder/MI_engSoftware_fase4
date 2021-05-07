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

searchBtn.addEventListener("click",function(){
    /*
    Mostrar o usuário buscado
    */
    let userDataDiv = document.getElementById('user_Data');
    let corenUserData = document.getElementById('corenUser');
    if(userDataDiv.style.display === "none"){
        userDataDiv.style.display = "";
    }

    var i = selectMudanca.length;
    do{
        selectMudanca.remove(0);
        i --;
    }while(i > 0);

    if(atribuiçãoAtual.innerHTML === "Enfermeiro Chefe" || atribuiçãoAtual.innerHTML === "Enfermeiro"){

        selectMudanca.appendChild(EnfermeiroChefe);
        selectMudanca.appendChild(Enfermeiro);
        corenUserData.style.display = "";
        if(atribuiçãoAtual.innerHTML === "Enfermeiro Chefe"){
            selectMudanca.value = "Enfermeiro Chefe";
        }
        else{
            selectMudanca.value = "Enfermeiro";
        }
        
    } else{

        selectMudanca.appendChild(EnfermeiroChefe);
        selectMudanca.appendChild(Enfermeiro);
        selectMudanca.appendChild(Estagiario);
        corenUserData.style.display = "none";
        selectMudanca.value = "Estagiário";
    }
})

selectMudanca.addEventListener("change",function(){
    var CorenDiv = document.getElementById('corenDiv');
    var CorenInpt = document.getElementById('fcoren');
    if(atribuiçãoAtual.innerHTML === "Estagiário"){
        if(selectMudanca.value === "Enfermeiro Chefe" || selectMudanca.value === "Enfermeiro"){ 
            CorenDiv.style.display = "";
            if(CorenInpt.hasAttribute("required") === false){
                CorenInpt.setAttribute("required","");
            }
        }
        else{
            CorenDiv.style.display = "none";
            if(CorenInpt.hasAttribute("required")){
                CorenDiv.style.display = "none";
                CorenInpt.removeAttribute("required");
            }
        }
    }
})
