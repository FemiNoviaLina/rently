const showButton = document.getElementById('rent-button');
const showMenu = document.getElementById('rent-menu');
const toggleMenu = document.getElementById('menu-toggle'); 
const menuList = document.getElementById('menu-list');

showButton.onclick = (event) => {
    event.preventDefault();
    showMenu.style.display = showMenu.style.display == 'none' ? 'block': 'none';
}

toggleMenu.onclick = (event) => {
    event.preventDefault();
    menuList.style.maxHeight = menuList.style.maxHeight == '0px' ? '1000px': '0px';
}