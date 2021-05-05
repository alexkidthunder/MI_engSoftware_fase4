/*$('.edit').click(function(){

    $('.change').html(
        '<div class="change">'+
            '<form id="register">'+
                '<div class="row">'+
                    '<div class="col-lg-12">'+
                        '<label>Nome</label> <br>'+
                        '<input id="fnome" name="fnome" type="text" maxlength="50" required>'+
                    '</div>'+
                '</div>'+

                '<div class="row">'+
                    '<div class="col-lg-4">'+
                        '<label>Data de Nascimento</label> <br>'+
                        '<input id="fnascimento" name="fnascimento" type="date" required>'+
                    '</div>'+
                    '<div class="col-lg-4">'+
                        '<label>CPF</label> <br>'+
                        '<input id="fcpf" name="fcpf" type="text" required maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">'+
                        '</div>'+
                        '<div class="col-lg-4">'+
                            '<div class="sex-form">'+
                                '<label>Sexo</label> <br>'+
                                '<input id="MASCULINO" name="fsexo" value="Masculino" type="button">'+
                                '<input id="FEMININO" name="fsexo" value="Feminino" type="button">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+

                    '<div class="row">'+
                        '<div class="col-lg-8">'+
                            '<label>Email</label> <br>'+
                            '<input id="femail" name="femail" type="email" maxlength="50" required>'+
                        '</div>'+
                    '</div>'+
                    '</form>'+
                    '</div>'
                        
    );
}) */

var nomeInp = document.getElementById('fnome');
var fmInp = document.getElementById('fmasc');
var ffInp = document.getElementById('ffem');
var emailInp = document.getElementById('femail');

var confBtnDiv = document.getElementById('confirm_info_div');
var editBtnDiv = document.getElementById('edit_info_div');
var passBtnDiv = document.getElementById('psw_info_div');

var pswArea = document.getElementById('psw');
var pflArea = document.getElementById('register');

var editBnt = document.getElementById('edit_info');
editBnt.addEventListener("click",function(){
    editBtnDiv.style.display = "none";
    confBtnDiv.style.display = "";
    passBtnDiv.style.display = "";

    nomeInp.removeAttribute("disabled");
    fmInp.removeAttribute("disabled");
    ffInp.removeAttribute("disabled");
    emailInp.removeAttribute("disabled");
})

var confBtn = document.getElementById('confirm_info');
confBtn.addEventListener("click",function(){
    editBtnDiv.style.display = "";
    confBtnDiv.style.display = "none";
    passBtnDiv.style.display = "none";

    nomeInp.setAttribute("disabled","");
    fmInp.setAttribute("disabled","");
    ffInp.setAttribute("disabled","");
    emailInp.setAttribute("disabled","");
})


var pswInp = document.getElementById('psw_info');
pswInp.addEventListener("click",function(){

    pflArea.style.display = "none";
    pswArea.style.display = "";

})


var backBtn = document.getElementById('fback');
backBtn.addEventListener("click",function(){

    editBtnDiv.style.display = "";
    confBtnDiv.style.display = "none";
    passBtnDiv.style.display = "none";

    pflArea.style.display = "";
    pswArea.style.display = "none";

    nomeInp.setAttribute("disabled","");
    fmInp.setAttribute("disabled","");
    ffInp.setAttribute("disabled","");
    emailInp.setAttribute("disabled","");
})

var atribuiInp = document.getElementById('fatribui');
let corenDiv =  document.getElementById('corenDiv');
console.log("Chegou aqui");
if(atribuiInp.value === "Enfermeiro" || atribuiInp.value === "Enfermeiro Chefe"){
    corenDiv.style.display = "";
    console.log("Chegou na parte do coren");
}
else{
    corenDiv.style.display = "none";
    console.log("Passou reto");
    }
