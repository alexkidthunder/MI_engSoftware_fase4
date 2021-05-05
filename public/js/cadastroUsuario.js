var selAtri = document.getElementById('fatribui');

selAtri.addEventListener("change",function(){
    let selectedAtri = selAtri.value;
    let corenDiv = document.getElementById('corenDiv');
    let fcoren = document.getElementById('fcoren');
    if(selectedAtri === "Enfermeiro" || selectedAtri === "Enfermeiro Chefe"){
        corenDiv.style.display = "";
        fcoren.setAttribute("required","");
    }
    else{
        corenDiv.style.display = "none";
        fcoren.removeAttribute("required");
    }
})