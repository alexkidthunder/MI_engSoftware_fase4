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
function replaceCargoText() {
    if (sessionStorage.getItem("Atribuicao") === "admin") {
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ADMIN', 'ADMINISTRADOR');
        titulo.classList.add('hide');
        titulo2.classList.add('hide');
        titulo3.classList.add('hide');
        titulo4.classList.add('hide');
    }
    else if (sessionStorage.getItem("Atribuicao") === "enfermeiroChefe") {
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ENFERMEIROCHEFE', "ENFERMEIRO CHEFE");
    }
    else if (sessionStorage.getItem("Atribuicao") === "estagiario") {
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ESTAGIARIO', 'ESTAGIÁRIO');
    }
}
