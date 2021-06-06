
var selectPacienteEProntuario = document.getElementById("novaAtribuicao");

selectPacienteEProntuario.addEventListener('change',function(){
   valor_select = selectPacienteEProntuario.value;
   sessionStorage.setItem("paciente_prontuario",valor_select);
});

document.addEventListener('DOMContentLoaded',function(){
    if(sessionStorage.getItem("paciente_prontuario") != null){
        value_saved = sessionStorage.getItem("paciente_prontuario");
        selectPacienteEProntuario.value = value_saved;
    }
})