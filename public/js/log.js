if(sessionStorage.getItem("index_pag") == null){
    sessionStorage.setItem("inicio",'0');
    sessionStorage.setItem("fim",'20');
    sessionStorage.setItem("index_pag",'1');
    sessionStorage.setItem("increment",'20');
}

function SaveData(){

}
function UpdateData(){
    sessionStorage.setItem("inicio",'0');
}
function previousTable(){

}
function nextTable(){

}

function UpdateTable(){

    var log_table = document.getElementById('Log_table');
    console.log('Temos um Log');
    console.log('Temos um Log');
    Log_body = log_table.getElementsByTagName('tr');
    Log_list = Array.prototype.slice.call(Log_body);
    Log_list.forEach(element => {

    });
}

document.addEventListener('DOMContentLoaded',UpdateTable());
