const sidebar = document.querySelector('#sidebar');
const sidebarToggler = document.querySelector('.sidebar_toggler');


// Alternando a barra lateral
sidebarToggler.addEventListener('click', () => {
    sidebar.classList.toggle('show');
});


// Fechando a barra lateral ao clicar fora e nos links da barra lateral
window.addEventListener('click', (e) => {
    if (e.target.id !== 'sidebar' && e.target.className !== 'sidebar_toggler') {
        sidebar.classList.remove('show');
    }
});