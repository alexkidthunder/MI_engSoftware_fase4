/**
 * Botão de busca de usuário
 */
var searchBtn = document.getElementById('busca_user');

searchBtn.addEventListener("click",function(){
    /**
     * Mostra dados do usuário buscado
     */
    let userDataDiv = document.getElementById('user_Data');
    if(userDataDiv.classList.contains('hide')){
        userDataDiv.classList.remove('hide');
    }
})

/**
 * Botão de cadastro de agendamento
 */
var regBtn = document.getElementById('btn_register_medicine');

regBtn.addEventListener("click",function(){
    /**
     * Div onde o registro de agendamento se encontra
     */
    let medicineRegister = document.getElementById('register');
    if(medicineRegister.classList.contains('hide')){
        medicineRegister.classList.remove('hide');
    }
})

/**
 * Botâo de alocação de um funcionário ao agendamento
 */
var alocBnt = document.getElementById('aloc_btn');

alocBnt.addEventListener("click",function(){
    let alocInpt = document.getElementById('aloc_inp');
    if(alocInpt.hasAttribute("disabled")){
        alocInpt.removeAttribute("disabled");
    }
    else{
        alocInpt.setAttribute("disabled","");
    }
})