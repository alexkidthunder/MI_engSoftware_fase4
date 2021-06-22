window.addEventListener('resize',function(){
    var change_container = document.getElementById('change-user-container');
    if(window.innerWidth >= 770){
        change_container.classList.add('container-button');
        change_container.classList.remove('content-center');
    } else {
        change_container.classList.remove('container-button');
        change_container.classList.add('content-center');
    }
})