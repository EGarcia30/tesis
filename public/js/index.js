const menu = document.getElementById('icon-menu');
const close = document.getElementById('icon-close');
const vertMenu = document.getElementById('vertical-menu');
// const content = document.getElementById('main-content');
const bgMenu = document.getElementById('back-menu');

function Show(){
    close.classList.remove('close');
    menu.classList.toggle('close');
    bgMenu.style.display = "block";
    vertMenu.classList.toggle('show');
    vertMenu.classList.remove('hide');
}

function Hide(){
    close.classList.toggle('close');
    menu.classList.remove('close');
    bgMenu.style.display = "none";
    vertMenu.classList.remove('show');
    vertMenu.classList.toggle('hide');
}

menu.addEventListener('click', Show);
close.addEventListener('click', Hide);
bgMenu.addEventListener('click', Hide);
