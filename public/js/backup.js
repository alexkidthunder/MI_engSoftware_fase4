var agendaBtn = document.getElementById("agenBack");

agendaBtn.addEventListener("click",function(){

    var agendamento = document.getElementById("AgendamentoBackup");
    if(!agendamento.classList.contains('hide')){
        agendamento.classList.add('hide');
    } else {
        agendamento.classList.remove('hide');
    }

})


var alwaysCheck = document.getElementById("alwaysCheck");

alwaysCheck.addEventListener("click",function(){

    var dataRequired = document.getElementById("date");
    var dataDiv = document.getElementById("dataDiv");
    if(!dataDiv.classList.contains('hide')){
        dataDiv.classList.add('hide');
        dataRequired.removeAttribute("required");
    } else {
        dataDiv.classList.remove('hide');
        dataRequired.setAttribute("required", "");
    }
})