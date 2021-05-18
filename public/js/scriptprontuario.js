var container = document.getElementById("container-teste");
var button = document.getElementById("action-btn");
var container2 = document.getElementById("container-teste2");
var button2 = document.getElementById("action-btn2");
var container3 = document.getElementById("container-teste3");
var button3 = document.getElementById("action-btn3");
var container4 = document.getElementById("container-teste4");
var button4 = document.getElementById("action-btn4");
var container5 = document.getElementById("container-teste5");
var button5 = document.getElementById("action-btn5");
var container6 = document.getElementById("container-teste6");
var button6 = document.getElementById("action-btn6");

var esconde;

button.addEventListener("click", function() {

     esconde = document.getElementById("container-teste");

     if(esconde.classList.contains('hide')){
         esconde.classList.remove('hide');
     } else {
         esconde.classList.add('hide');
     }
});

button2.addEventListener("click", function() {

     esconde = document.getElementById("container-teste2");

    if(esconde.classList.contains('hide')){
        esconde.classList.remove('hide');
    } else {
        esconde.classList.add('hide');
    }
});

button3.addEventListener("click", function() {

     esconde = document.getElementById("container-teste3");

    if(esconde.classList.contains('hide')){
        esconde.classList.remove('hide');
    } else {
        esconde.classList.add('hide');
    }
});

button4.addEventListener("click", function() {

    esconde = document.getElementById("container-teste4");

    if(esconde.classList.contains('hide')){
        esconde.classList.remove('hide');
    } else {
        esconde.classList.add('hide');
    }
});

button5.addEventListener("click", function() {

    esconde = document.getElementById("container-teste5");

    if(esconde.classList.contains('hide')){
        esconde.classList.remove('hide');
    } else {
        esconde.classList.add('hide');
    }
});

button6.addEventListener("click", function() {

    esconde = document.getElementById("container-teste6");

    if(esconde.classList.contains('hide')){
        esconde.classList.remove('hide');
    } else {
        esconde.classList.add('hide');
    }
});