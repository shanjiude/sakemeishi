// JavaScript
function toggleMenu() {
    const menu = document.getElementById("profileMenu");
    menu.classList.toggle("hidden");
}

document.addEventListener('DOMContentLoaded', () => {
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    hamburgerBtn.addEventListener('click', toggleMenu);
});
