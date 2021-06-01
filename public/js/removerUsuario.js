
window.addEventListener('resize',function(){
    var del_container = document.getElementById('delete-user-container');
    console.log("Largura: " + this.window.innerWidth + "px");
    if(window.innerWidth >= 992){
        del_container.classList.add('container-button');
        del_container.classList.remove('content-center');
    } else {
        del_container.classList.remove('container-button');
        del_container.classList.add('content-center');
    }
})