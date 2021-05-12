var record = document.getElementById('record');
var buscaBtn = document.getElementById('busca_user');

buscaBtn.addEventListener('click',function(){
    console.log("funcinou");
    if(record.classList.contains("hide")){
        record.classList.remove("hide");
        console.log("funcinou corretamente");
    }
})