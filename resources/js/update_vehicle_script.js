const viewButton = document.getElementById('view-image');
const updateButton = document.getElementById('update-image');
const modal = document.getElementById('modal');
const lightbox = document.getElementById('lightbox');

viewButton.addEventListener('click', () => {
    lightbox.style.display = 'flex';
})

updateButton.addEventListener('click', () => {
    modal.style.display = 'flex';
})

window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    } else if (event.target == lightbox) {
        lightbox.style.display = "none";
    }
}

$("#close").on("click", () => {
    $("#modal").css('display','none');
});
