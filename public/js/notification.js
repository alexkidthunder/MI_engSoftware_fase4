/**
 * Botão de fechar notificação
 */
button = document.getElementById('close');

/**
 * Box de notificação
 */
box = document.getElementById('notification');

button.addEventListener('click',function(){
    box.classList.add('hide');
    console.log();
})