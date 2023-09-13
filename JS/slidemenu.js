const openMenuButton = document.getElementById('openMenuButton');
const slideMenu = document.getElementById('slideMenu');

openMenuButton.addEventListener('click', () => {
    if (slideMenu.style.width === '250px') {
        // Fecha o menu se estiver aberto
        slideMenu.style.width = '0';
        openMenuButton.style.left = '20px'
    } else {
        // Abre o menu
        openMenuButton.style.left = '55%';
        slideMenu.style.width = '250px';
    }
});