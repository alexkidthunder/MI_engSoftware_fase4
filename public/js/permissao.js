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
 * Quando for escolhido um cargo no select, ele irá salvar essa opção em um
 * sessionStorage
 */
selectAtribuicao.addEventListener('change',function(){
    sessionStorage.clear();
    sessionStorage.setItem("Atribuicao",selectAtribuicao.value);
    
})

/**
 * Quando o DOM da página for carregado, ele pegará
 * a informação sobre o Cargo na sessionStorage, coloca-la
 * em um texto e, logo após, apaga a informação da sessionStorage
 */
document.addEventListener("DOMContentLoaded", function(){
    text = sessionStorage.getItem("Atribuicao");
    text = text.toString();
    text = text.toUpperCase();
    h3NomePermissao.innerHTML = "PERMISSÕES DO " + text;
    replaceCargoText();
    sessionStorage.clear();
});

/**
 * Substitui os nomes incompletos pelos nomes padrão do sistema
 */
function replaceCargoText(){
    if(sessionStorage.getItem("Atribuicao") === "admin"){
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ADMIN','ADMINISTRADOR');
    }
    else if(sessionStorage.getItem("Atribuicao") === "enfermeiroChefe"){
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ENFERMEIROCHEFE',"ENFERMEIRO CHEFE");
    }
    else if(sessionStorage.getItem("Atribuicao") === "estagiario"){
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ESTAGIARIO','ESTAGIÁRIO');
    }
}