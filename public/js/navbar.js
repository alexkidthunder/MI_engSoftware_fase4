nav_itens = document.getElementsByName('nav-item')

userName = document.getElementById('user-name'); // Nome do usuário

function splitFirstName(NomeCompleto){
    Nome = NomeCompleto.split(' ');
    PrimeiroNome = Nome[0] + " " + Nome[Nome.length-1];
    return PrimeiroNome;
}

function addClearEvent(ListHtmlElement){
    ListHtmlElement.forEach(element =>{
        element.addEventListener('click',function(){
            sessionStorage.clear();
        })
    })
}

document.addEventListener("DOMContentLoaded", function(event) {
    addClearEvent(nav_itens);
    nome = userName.innerHTML;
    primeiroNome = splitFirstName(nome);
    userName.innerHTML = primeiroNome;
});

menu_options = document.getElementById('check-options');

nav = document.getElementById('nav');

if(menu_options != null){
    menu_options.addEventListener('click',function(){
        nav.classList.toggle('active');
        sessionStorage.clear();
    });
}