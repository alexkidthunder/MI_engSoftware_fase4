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

var esconde;

button.addEventListener("click", function() {

     esconde = document.getElementById("container-teste");

     if(esconde.style.display === "none"){
         esconde.style.display = "block";
     } else {
         esconde.style.display = "none";
     }
});

button2.addEventListener("click", function() {

     esconde = document.getElementById("container-teste2");

    if(esconde.style.display === "none"){
        esconde.style.display = "block";
    } else {
        esconde.style.display = "none";
    }
});

button3.addEventListener("click", function() {

     esconde = document.getElementById("container-teste3");

    if(esconde.style.display === "none"){
        esconde.style.display = "block";
    } else {
        esconde.style.display = "none";
    }
});

button4.addEventListener("click", function() {

    esconde = document.getElementById("container-teste4");

    if(esconde.style.display === "none"){
        esconde.style.display = "block";
    } else {
        esconde.style.display = "none";
    }
});

button5.addEventListener("click", function() {

    esconde = document.getElementById("container-teste5");

    if(esconde.style.display === "none"){
        esconde.style.display = "block";
    } else {
        esconde.style.display = "none";
    }
});