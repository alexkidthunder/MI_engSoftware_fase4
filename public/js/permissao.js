var selectAtribuicao = document.getElementById('atribuicao');
selectAtribuicao.value = "";

var h3NomePermissao = document.getElementById('Nome_Permissao');

selectAtribuicao.addEventListener('change',function(){
    sessionStorage.clear();
    sessionStorage.setItem("Atribuicao",selectAtribuicao.value);
    
})

document.addEventListener("DOMContentLoaded", function(){
    text = sessionStorage.getItem("Atribuicao");
    selectAtribuicao.value = text;
    text = text.toString();
    text = text.toUpperCase();
    h3NomePermissao.innerHTML = "PERMISSÕES DO " + text;
    replaceCargoText();
    sessionStorage.clear();
});

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