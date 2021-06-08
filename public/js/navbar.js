nav_item = document.getElementsByName('nav-item');

for(i = 0; i < nav_item.length;i++){
    nav_item[i].addEventListener('click',function(){
        sessionStorage.clear();
    });
}
