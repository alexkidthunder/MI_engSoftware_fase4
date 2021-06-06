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
/*if(atribuiInp.value === "Enfermeiro" || atribuiInp.value === "Enfermeiro Chefe"){
    corenDiv.classList.remove('hide');
}
else{
    corenDiv.classList.add('hide');
} */

/* -- Verifica se o sexo já foi escolhido, caso não, mostra os botões para escolher -- */
if(femInp.checked === false && mascInp.checked === false){
    addNoRadialEdit();
}
else{
    checkRadial();
}

/* -- ao clicar no botão "Editar Informações" -- */
editBnt.addEventListener("click",function(){

    enable();   // Habilita os inputs e Radios
  //  removeNoRadialEdit(); // Retira o estilo que indicava que não poderia editar
  //  addRadialEdit(); // Adiciona o estilo que indica que pode editar
  //  setSexRequired(); // Coloca o campo do sexo como Obrigatório
    setPerfilDataRequired(); // Coloca os campos habilitados como Obrigatórios
    toggleHideBtnPerfil(); // Esconde o botão de "Editar Informações" e Mostra os outros botões
  //  refreshSex(); // Retira as marcações do sexo
  //  checkRadial(); // Verifica se o sexo está marcado, se não estiver, volta ao estado padrão (mostrando os dois)

})

/* -- ao clicar no botão "Salvar" -- */
saveBtn.addEventListener("click",function(){

    //  disable(); // Desabilita os inputs e Radios
   // addNoRadialEdit(); // Adiciona o estilo que indica que não poderia editar
   // removeRadialEdit(); // Retira o estilo que indicava que pode editar
   // checkRadial(); // Verifica se o sexo está marcado, se não estiver, volta ao estado padrão (mostrando os dois)
    removePerfilDataRequired(); // Coloca os campos disabilitados (inputs) como Não-Obrigatórios
    removeSexRequired();  // Coloca o campo do sexo como Não-Obrigatório
    toggleHideBtnPerfil(); // Mostra o botão de "Editar Informações" e Esconde os outros botões

})


pswBtn.addEventListener("click",function(){

    removePerfilDataRequired();
    removeSexRequired();
    setPswRequired();
    pflArea.classList.add('hide');
    pswArea.classList.remove('hide');

})

cancelarBtn.addEventListener("click",function(){

   // disable();
    addNoRadialEdit();
    removeRadialEdit();
    pflArea.classList.remove('hide');
    pswArea.classList.add('hide');
    setInitialState();
    checkRadial();
    removePswRequired();

})
/**
 * bota "Required" nos campos de senha
 */
function setPswRequired(){
    SenhaAtual.setAttribute("required","");
    SenhaNova.setAttribute("required","")
    SenhaNovaConfirmacao.setAttribute("required","");
}
/**
 * remove "Required" nos campos de senha
 */
function removePswRequired(){
    SenhaAtual.removeAttribute("required");
    SenhaNova.removeAttribute("required");
    SenhaNovaConfirmacao.removeAttribute("required");
}

/**
 * retorna a tela para o estado inicial
 */
function setInitialState(){
    if(editBtnDiv.classList.contains('hide')){
        editBtnDiv.classList.remove('hide');
        saveBtnDiv.classList.add('hide');
    }
}
/**
 * Toggle para os estados da tela. 
 * Utiliza-se a classe Hide
 */
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
/**
 * Seta os Inputs de texto do perfil como Required
 */
function setPerfilDataRequired(){
    nomeInp.setAttribute("required","");
    emailInp.setAttribute("required","");
}
/**
 * Remove os Required dos Inputs de texto do perfil
 */
function removePerfilDataRequired(){
    nomeInp.removeAttribute("required");
    emailInp.removeAttribute("required");
}
/**
 * Seta os Inputs radiais do perfil como Required
 */
function setSexRequired(){
    radioSexBtn.forEach(element => {
        element.setAttribute("required","");
    });
}
/**
 * Remove os Required dos Inputs radiais do perfil
 */
function removeSexRequired(){
    radioSexBtn.forEach(element => {
        element.removeAttribute("required");
    });
}
/**
 * Reseta o estado dos botões radiais
 */
function refreshSex(){
    radioSexBtn.forEach(element => {
        if(element.checked){
            element.checked = false; 
        }
    })
}
/**
 * Adiciona um estilo ao botão para indicar que ele não
 * está no modo de edição
 */
function addNoRadialEdit(){
    radioFemDiv.classList.add("radial-no-edit");
    radioMascDiv.classList.add("radial-no-edit");
}
/**
 * Remove um estilo ao botão para indicar que ele não
 * está no modo de edição
 */
function removeNoRadialEdit(){
    radioFemDiv.classList.remove("radial-no-edit");
    radioMascDiv.classList.remove("radial-no-edit");
}
/**
 * Adiciona um estilo ao botão para indicar que ele
 * está no modo de edição
 */
function addRadialEdit(){
    radioFemDiv.classList.add("radial-edit");
    radioMascDiv.classList.add("radial-edit");
}
/**
 * Remove um estilo ao botão para indicar que ele
 * está no modo de edição
 */
function removeRadialEdit(){
    radioFemDiv.classList.remove("radial-edit");
    radioMascDiv.classList.remove("radial-edit");
}
/**
 * Verifica se o usuário já tem um sexo definido e esconde o outro sexo
 * 
 */
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
/**
 * Disabilita a edição dos dados do perfil - Dar Erro
 */
function disable(){
    nomeInp.setAttribute("disabled","");
    emailInp.setAttribute("disabled","");
}
/**
 * Habilita a edição dos dados do perfil
 */
function enable(){
    nomeInp.removeAttribute("disabled");
    emailInp.removeAttribute("disabled");
}
