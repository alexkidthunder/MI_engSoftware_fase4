/* -- Campos com as informações do usuário -- */
var nomeInp = document.getElementById('fnome');
var mascInp = document.getElementById('fmasc');
var femInp = document.getElementById('ffem');
var radioSexBtn = document.getElementsByName('fsexo');
var emailInp = document.getElementById('femail');
var corenDiv =  document.getElementById('corenDiv');
var atribuiInp = document.getElementById('fatribui');

/* -- Div que englobam os botões -- */
var saveBtnDiv = document.getElementById('confirm_info_div');
var editBtnDiv = document.getElementById('edit_info_div');
var pswBtnDiv = document.getElementById('psw_info_div');

/* -- As areas de dados do usuário (perfil) e a parte de trcar a senha -- */
var pswArea = document.getElementById('pswArea');
var pflArea = document.getElementById('perfilArea');

/* -- Div com os radio button do sexo -- */
var radioMascDiv = document.getElementById('fmasc_div');
var radioFemDiv = document.getElementById('ffem_div');

/* -- Botões presentes na tela de perfil -- */
var editBnt = document.getElementById('edit_info');
var saveBtn = document.getElementById('confirm_info');
var pswBtn = document.getElementById('psw_info');

/* -- Botões presentes na tela de alterar senha -- */
var cancelarBtn = document.getElementById('cancelar');
var alterarBtn = document.getElementById('alterarSenha');

/* -- Inputs presentes na tela de alterar senha -- */
var SenhaAtual = document.getElementById('senha-atual');
var SenhaNova = document.getElementById('senha');
var SenhaNovaConfirmacao = document.getElementById('confirmacao');

/* -- Verifica a atribuição e mostra, ou não, a informação do coren -- */
if(atribuiInp.value === "Enfermeiro" || atribuiInp.value === "Enfermeiro Chefe"){
    corenDiv.classList.remove('hide');
}
else{
    corenDiv.classList.add('hide');
}

/* -- Verifica se o sexo já foi escolhido, caso não, mostra os botões para escolher -- */
if(femInp.checked === false && mascInp.checked === false){
    addNoRadialEdit();
}
else{
    checkRadial();
}

/* -- ao clicar no botão "Editar Informações" -- */
editBnt.addEventListener("click",function(){

    enable();   
    removeNoRadialEdit();
    addRadialEdit();
    setSexRequired();
    setPerfilDataRequired();
    toggleHideBtnPerfil();
    refreshSex();
    checkRadial();

})

/* -- ao clicar no botão "Salvar" -- */
saveBtn.addEventListener("click",function(){

    disable();
    addNoRadialEdit();
    removeRadialEdit();
    checkRadial();
    removePerfilDataRequired();
    removeSexRequired();
    toggleHideBtnPerfil();

})


pswBtn.addEventListener("click",function(){

    removePerfilDataRequired();
    removeSexRequired();
    setPswRequired();
    pflArea.classList.add('hide');
    pswArea.classList.remove('hide');

})

cancelarBtn.addEventListener("click",function(){

    disable();
    addNoRadialEdit();
    removeRadialEdit();
    pflArea.classList.remove('hide');
    pswArea.classList.add('hide');
    setInitialState();
    checkRadial();
    removePswRequired();

})

function setPswRequired(){
    SenhaAtual.setAttribute("required","");
    SenhaNova.setAttribute("required","")
    SenhaNovaConfirmacao.setAttribute("required","");
}
function removePswRequired(){
    SenhaAtual.removeAttribute("required");
    SenhaNova.removeAttribute("required");
    SenhaNovaConfirmacao.removeAttribute("required");
}
function setInitialState(){
    if(editBtnDiv.classList.contains('hide')){
        editBtnDiv.classList.remove('hide');
        saveBtnDiv.classList.add('hide');
    }
}
function toggleHideBtnPerfil(){
    if(saveBtnDiv.classList.contains('hide')){
        editBtnDiv.classList.add('hide');
        saveBtnDiv.classList.remove('hide');
    }
    else if(editBtnDiv.classList.contains('hide')){
        editBtnDiv.classList.remove('hide');
        saveBtnDiv.classList.add('hide');
    }
}
function setPerfilDataRequired(){
    nomeInp.setAttribute("required","");
    emailInp.setAttribute("required","");
}
function removePerfilDataRequired(){
    nomeInp.removeAttribute("required");
    emailInp.removeAttribute("required");
}
function setSexRequired(){
    radioSexBtn.forEach(element => {
        element.setAttribute("required","");
    });
}
function removeSexRequired(){
    radioSexBtn.forEach(element => {
        element.removeAttribute("required");
    });
}
function refreshSex(){
    radioSexBtn.forEach(element => {
        if(element.checked){
            element.checked = false; 
        }
    })
}
function addNoRadialEdit(){
    radioFemDiv.classList.add("radial-no-edit");
    radioMascDiv.classList.add("radial-no-edit");
}
function removeNoRadialEdit(){
    radioFemDiv.classList.remove("radial-no-edit");
    radioMascDiv.classList.remove("radial-no-edit");
}
function addRadialEdit(){
    radioFemDiv.classList.add("radial-edit");
    radioMascDiv.classList.add("radial-edit");
}
function removeRadialEdit(){
    radioFemDiv.classList.remove("radial-edit");
    radioMascDiv.classList.remove("radial-edit");
}

function checkRadial(){
    if(femInp.checked === true){
        radioMascDiv.classList.add('hide');
    }
    else if(mascInp.checked === true){
        radioFemDiv.classList.add('hide');
    }
    else{
        radioMascDiv.classList.remove('hide');
        radioFemDiv.classList.remove('hide');
    }
}

function disable(){
    nomeInp.setAttribute("disabled","");
    mascInp.setAttribute("disabled","");
    femInp.setAttribute("disabled","");
    emailInp.setAttribute("disabled","");
}

function enable(){
    nomeInp.removeAttribute("disabled");
    mascInp.removeAttribute("disabled");
    femInp.removeAttribute("disabled");
    emailInp.removeAttribute("disabled");
}
