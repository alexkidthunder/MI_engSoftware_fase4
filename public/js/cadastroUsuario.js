/**
 * Seletor de atribuição para cadastrar usuário
 */
var selAtri = document.getElementById('fatribui');


document.addEventListener('DOMContentLoaded',function(){
    reloadCorenDiv()
})

selAtri.addEventListener("change",function(){
    reloadCorenDiv();
});
/**
 * Mostra ou Esconde a opção de digitar o Coren
 */
function reloadCorenDiv(){
    let selectedAtri = selAtri.value;
    let corenDiv = document.getElementById('corenDiv');
    let fcoren = document.getElementById('fcoren');
    if(selectedAtri === "Enfermeiro" || selectedAtri === "Enfermeiro Chefe"){
        corenDiv.classList.remove('hide');
        fcoren.setAttribute("required","");
    }
    else{
        corenDiv.classList.add('hide');
        fcoren.removeAttribute("required");
    }
}