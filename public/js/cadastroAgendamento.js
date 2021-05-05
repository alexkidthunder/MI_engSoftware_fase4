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