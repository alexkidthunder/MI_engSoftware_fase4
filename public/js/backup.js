var agendaBtn = document.getElementById("agenBack");

agendaBtn.addEventListener("click",function(){

    var agendamento = document.getElementById("AgendamentoBackup");
    if(agendamento.style.display === "none"){
        agendamento.style.display = "";
    } else {
        agendamento.style.display = "none";
    }

})


var alwaysCheck = document.getElementById("alwaysCheck");

alwaysCheck.addEventListener("click",function(){

    var dataRequired = document.getElementById("date");
    var dataDiv = document.getElementById("dataDiv");
    if(dataDiv.style.display ==="none"){
        dataDiv.style.display = "";
        dataRequired.setAttribute("required", "");
    } else {
        dataDiv.style.display = "none";
        dataRequired.removeAttribute("required");
    }
})