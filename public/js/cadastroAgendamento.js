var searchBtn = document.getElementById('busca_user');

searchBtn.addEventListener("click",function(){
    /*
    Mostrar o usuário buscado
    */
    let userDataDiv = document.getElementById('user_Data');
    if(userDataDiv.style.display === "none"){
        userDataDiv.style.display = "";
    }
})

var regBtn = document.getElementById('btn_register_medicine');

regBtn.addEventListener("click",function(){
    let medicineRegister = document.getElementById('register');
    if(medicineRegister.style.display === "none"){
        medicineRegister.style.display = "";
    }
})

var alocBnt = document.getElementById('aloc_btn');

alocBnt.addEventListener("click",function(){
    let alocInpt = document.getElementById('aloc_inp');
    if(alocInpt.hasAttribute("readonly")){
        alocInpt.removeAttribute("readonly");
    }
    else{
        alocInpt.setAttribute("readonly","");
    }
})