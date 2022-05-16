const showButton = document.getElementById('rent-button');
const showMenu = document.getElementById('rent-menu');
const toggleMenu = document.getElementById('menu-toggle'); 
const menuList = document.getElementById('menu-list');
const menuOption = document.getElementsByClassName('rent-menu-option');

toggleMenu.onclick = (event) => {
    event.preventDefault();
    menuList.style.maxHeight = menuList.style.maxHeight == '0px' ? '1000px': '0px';
}

menuOption[0].onclick = (event) => {
    event.preventDefault();
    if(menuOption[0].innerHTML == 'Rent Car') {
        window.location.href = window.location.origin + '/find/car';
    } else {
        window.location.href = window.location.origin + '/dashboard/vehicles/car';
    }
}

menuOption[1].onclick = (event) => {
    event.preventDefault();
    if(menuOption[0].innerHTML == 'Rent Car') {
        window.location.href = window.location.origin + '/find/motor';
    } else {
        window.location.href = window.location.origin + '/dashboard/vehicles/motor';
    }
}

showButton.onclick = (event) => {
    event.preventDefault();
    showMenu.style.display = showMenu.style.display == 'none' ? 'block': 'none';
}