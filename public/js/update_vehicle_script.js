/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/update_vehicle_script.js ***!
  \***********************************************/
var viewButton = document.getElementById('view-image');
var updateButton = document.getElementById('update-image');
var modal = document.getElementById('modal');
var lightbox = document.getElementById('lightbox');
viewButton.addEventListener('click', function () {
  lightbox.style.display = 'flex';
});
updateButton.addEventListener('click', function () {
  modal.style.display = 'flex';
});

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  } else if (event.target == lightbox) {
    lightbox.style.display = "none";
  }
};

$("#close").on("click", function () {
  $("#modal").css('display', 'none');
});
/******/ })()
;