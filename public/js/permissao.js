var selectAtribuicao = document.getElementById('atribuicao');
selectAtribuicao.value = "";

var h3NomePermissao = document.getElementById('Nome_Permissao');

selectAtribuicao.addEventListener('change',function(){
    localStorage.clear();
    localStorage.setItem("Atribuicao",selectAtribuicao.value);
    console.log("Atribuicao salva: " + localStorage.getItem("Atribuicao"));
})

document.addEventListener("DOMContentLoaded", function(){
    console.log("Conteudo Carregado! " + localStorage.getItem("Atribuicao"));
    console.log("innerHTML: " + h3NomePermissao.innerHTML);
    text = localStorage.getItem("Atribuicao");
    text = text.toString();
    text = text.toUpperCase();
    h3NomePermissao.innerHTML = "PERMISSÕES DO " + text;
    replaceCargoText()
    localStorage.clear();
});

 function replaceCargoText(){
     if(localStorage.getItem("Atribuicao") === "admin"){
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ADMIN','ADMINISTRADOR');
     }
     else if(localStorage.getItem("Atribuicao") === "enfermeiroChefe"){
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ENFERMEIROCHEFE',"ENFERMEIRO CHEFE");
     }
     else if(localStorage.getItem("Atribuicao") === "estagiario"){
        h3NomePermissao.innerHTML = h3NomePermissao.innerHTML.replace('ESTAGIARIO','ESTAGIÁRIO');
     }
 }