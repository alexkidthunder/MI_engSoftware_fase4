/**
 * Select onde estão os cargos
 *
 * */
var selectAtribuicao = document.getElementById('atribuicao');


/**
 * Faz o select não ter nada selecionado
 */
selectAtribuicao.value = "";

/**
 * Area de texto onde indicamos qual permissão está sendo vista
 */
var h3NomePermissao = document.getElementById('Nome_Permissao');


/**
 * Títulos para cada grupo da permissao
 */
var titulo = document.getElementById('title')
var titulo2 = document.getElementById('title-2')
var titulo3 = document.getElementById('title-3')
var titulo4 = document.getElementById('title-4')

/**
 * Cada permissão agrupadas em uma nodeList conforme seu grupo de
 * permissões
 */
 var admin_perm = document.getElementsByName("adm");
 var paciente_perm = document.getElementsByName("paciente");
 var gerencia_hospitalar_perm = document.getElementsByName("gerenciamento_hospitalar");
 var gerencia_perm = document.getElementsByName("gerenciamento");
 var agendamento_perm = document.getElementsByName("agendamento");

/**
 * Botão de alterar em permissões
 */
var alterar_btn = document.getElementById("alterar");

/**
 * Texto de quantidade de alterações
 */
 var num_alt = document.getElementById("num_alteracao");

/**
 * Quando for escolhido um cargo no select, ele irá salvar essa opção em um
 * sessionStorage
 */
selectAtribuicao.addEventListener('change', function () {
    sessionStorage.clear();
    sessionStorage.setItem("Atribuicao", selectAtribuicao.value);

})

/**
 * Quando o DOM da página for carregado, ele pegará
 * a informação sobre o Cargo na sessionStorage, coloca-la
 * em um texto e, logo após, apaga a informação da sessionStorage
 */
document.addEventListener("DOMContentLoaded", function () {
    setAtribuicaoText();
    saveStateToSessionStorage();
    num_alt.innerHTML = "Alterações: " + state;
    addTransition();

});

function alterarBtnOnDemand(){
    if(state > 0){
        alterar_btn.classList.remove('hide');
    }
    else{
        alterar_btn.classList.add('hide');
    }
    num_alt.innerHTML = "Alterações: " + state;
}

var state = 0;

function compareState(element,name,id){
    let checado = element.checked;
    var savedState = sessionStorage.getItem(name+'-'+ id);
    if(savedState === "true"){
        val = true;
    }
    else{
        val = false;
    }
    if(val == checado){
        state--;
        element.parentElement.classList.remove("highlight-change");
    }
    else{
        state++;
        element.parentElement.classList.add("highlight-change");
    }
}

function addToggleEvent(ListHtmlElement){
    ListHtmlElement.forEach(element =>{
        console.log(element.checked + " Toggle Event");
        element.addEventListener('click',function(){
            console.log(element.checked + " Inside Function");
            compareState(element,element.getAttribute("name"),element.getAttribute("id"));
            alterarBtnOnDemand();
        })
    })
}

/**
 * 
 */
function saveStateToSessionStorage(){
    admin_perm.forEach(element => {
        sessionStorage.setItem("adm-" + element.getAttribute("id"),element.checked);
    });
    paciente_perm.forEach(element =>{
        sessionStorage.setItem("paciente-" + element.getAttribute("id"),element.checked);
    })
    gerencia_hospitalar_perm.forEach(element =>{
        sessionStorage.setItem("gerenciamento_hospitalar-"+ element.getAttribute("id"),element.checked);
    })
    gerencia_perm.forEach(element =>{
        sessionStorage.setItem("gerenciamento-" + element.getAttribute("id"),element.checked);
    })
    agendamento_perm.forEach(element =>{
        sessionStorage.setItem("agendamento-" + element.getAttribute("id"),element.checked);
    })    
}
/**
 * ele pegará a informação sobre o Cargo na sessionStorage, coloca-la
 * em um texto e, logo após, apaga a informação da sessionStorage
 */
function setAtribuicaoText(){
    text = sessionStorage.getItem("Atribuicao");
    text = text.toString();
    text = text.toUpperCase();
    h3NomePermissao.innerHTML = "PERMISSÕES DO " + text;
    replaceCargoText();
    sessionStorage.removeItem("Atribuicao");
}

/**
 * Substitui os nomes incompletos pelos nomes padrão do sistema
 */
function replaceCargoText() {
    if (sessionStorage.getItem("Atribuicao") === "admin") {
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ADMIN', 'ADMINISTRADOR');
        titulo.classList.add('hide');
        titulo2.classList.add('hide');
        titulo3.classList.add('hide');
        titulo4.classList.add('hide');
        addToggleEvent(admin_perm);

    }
    else if (sessionStorage.getItem("Atribuicao") === "enfermeiroChefe") {
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ENFERMEIROCHEFE', "ENFERMEIRO CHEFE");

    }
    else if (sessionStorage.getItem("Atribuicao") === "estagiario") {
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ESTAGIARIO', 'ESTAGIÁRIO');

    }
    if(sessionStorage.getItem("Atribuicao") != "admin"){
        addToggleEvent(paciente_perm);
        addToggleEvent(gerencia_hospitalar_perm);
        addToggleEvent(gerencia_perm);
        addToggleEvent(agendamento_perm);
    }
}

function addTransition(){
    admin_perm.forEach(element =>{
        element.parentElement.classList.add("transition-1s");
    })
    paciente_perm.forEach(element =>{
        element.parentElement.classList.add("transition-1s");
    })
    gerencia_hospitalar_perm.forEach(element =>{
        element.parentElement.classList.add("transition-1s");
    })
    gerencia_perm.forEach(element =>{
        element.parentElement.classList.add("transition-1s");
    })
    agendamento_perm.forEach(element =>{
        element.parentElement.classList.add("transition-1s");
    })
}
