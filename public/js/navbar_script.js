/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/navbar_script.js ***!
  \***************************************/
var showButton = document.getElementById('rent-button');
var showMenu = document.getElementById('rent-menu');
var toggleMenu = document.getElementById('menu-toggle');
var menuList = document.getElementById('menu-list');

showButton.onclick = function (event) {
  event.preventDefault();
  showMenu.style.display = showMenu.style.display == 'none' ? 'block' : 'none';
};

toggleMenu.onclick = function (event) {
  event.preventDefault();
  menuList.style.maxHeight = menuList.style.maxHeight == '0px' ? '1000px' : '0px';
};
/******/ })()
;