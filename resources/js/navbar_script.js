const showButton = document.getElementById('rent-button');
const showMenu = document.getElementById('rent-menu');
const toggleMenu = document.getElementById('menu-toggle'); 
const menuList = document.getElementById('menu-list');
const menuOption = document.getElementsByClassName('rent-menu-option');

menuOption[0].onclick = (event) => {
    event.preventDefault();
    window.location.href = window.location.origin + '/rent/cars';
}

menuOption[1].onclick = (event) => {
    event.preventDefault();
    window.location.href = window.location.origin + '/rent/motors';
}

showButton.onclick = (event) => {
    event.preventDefault();
    showMenu.style.display = showMenu.style.display == 'none' ? 'block': 'none';
}

toggleMenu.onclick = (event) => {
    event.preventDefault();
    menuList.style.maxHeight = menuList.style.maxHeight == '0px' ? '1000px': '0px';
}