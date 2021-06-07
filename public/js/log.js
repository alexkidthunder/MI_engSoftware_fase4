input_with_size = document.getElementById('tamanho_log');
log_show_size = document.getElementById('n_log');
size_log = document.getElementById('show_size');
size_log.innerHTML = "Temos "+input_with_size.value+" Logs Registrados";

selectValueNoChange();

function selectValueNoChange(){
    if(log_show_size.value == ""){
        sessionStorage.setItem("increment",25);
        log_show_size.value = 25;
    }
    else{
        let size = parseInt(sessionStorage.getItem("increment"));
        sessionStorage.setItem("increment",size);
        log_show_size.value = size;
    }
    saveInitialData();
}
function saveInitialData(){
    if(sessionStorage.getItem("index_pag") == null){
        sessionStorage.setItem("index_pag",'1');
        sessionStorage.setItem("increment",log_show_size.value);
        sessionStorage.setItem("Size",input_with_size.value);
    }
}
function calcPages(Size,Divider){
    var Page = Math.ceil(Size/Divider);
    return Page;
}
function UpdateData(){
    index_pag = parseInt(sessionStorage.getItem("index_pag"));
    increment = parseInt(sessionStorage.getItem("increment"));

    inicio = (index_pag-1)*increment;
    fim = (index_pag*increment);

    sessionStorage.setItem('inicio',inicio);
    sessionStorage.setItem('fim',fim);
}
function UpdateTable(){

    var log_table = document.getElementById('Log_table');
    Log_body = log_table.getElementsByTagName('tr');
    Log_list = Array.prototype.slice.call(Log_body);
    ClearTable(Log_list);
}

function ClearTable(Array){
    inicio = parseInt(sessionStorage.getItem('inicio'));
    fim = parseInt(sessionStorage.getItem('fim'));
    
    var MaxSize = parseInt(sessionStorage.getItem("Size"));
    for(i = MaxSize-1; 0 <= i; i--){
        if(i>=fim || i < inicio){
            console.log("Removeu");
            Array[i].remove();
        }
    }
}

function addClickEvent(){
    var paginators = document.getElementsByName("paginator");
    paginators.forEach(element =>{
        element.addEventListener("click",function(){
            sessionStorage.setItem("index_pag",element.value);
            location.reload();
        })
    })
}
function createListElement(parent){
    var li = document.createElement("li")
    li.setAttribute("value",i);
    li.setAttribute("name","paginator");
    li.innerHTML = i;
    li.classList.add('list-log-page');
    parent.appendChild(li);
}
function setNumberPage(){
    var list_page = document.getElementById("list-page");
    var page_div = document.getElementById('pagina_label');
    var pages = calcPages(input_with_size.value,increment);
    var paginaAtual= parseInt(sessionStorage.getItem("index_pag"));
    page_div.innerHTML = "Pagina " + paginaAtual + "/" + pages;
    console.log(pages);
    for(i = 1; i <= pages;i++){

        if(paginaAtual >= 4){
            if(i > (paginaAtual-3) && i<(paginaAtual+3)){
                createListElement(list_page);
            }
        }
        else if(paginaAtual < 4){
            if(i<(paginaAtual+3)){
               createListElement(list_page);
            }
        }
    }
    addClickEvent();
}

document.addEventListener('DOMContentLoaded',function(){
    selectValueNoChange();
    UpdateData();
    setNumberPage();
    UpdateTable();
    
});

log_show_size.addEventListener('change',function(){
    sessionStorage.setItem("increment",log_show_size.value);
    sessionStorage.setItem("index_pag",1);
    UpdateData();
    location.reload();
})