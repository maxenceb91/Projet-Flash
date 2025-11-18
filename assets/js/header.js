const headerMenu = document.querySelector(".menu");
const test = document.querySelector(".pp-menu");
const main = document.querySelector("main");

test.addEventListener('click', (event) => {
    headerMenu.classList.toggle('menu-visible');
    event.stopPropagation();
});

document.addEventListener('click', (event) => {
    if (headerMenu.classList.contains('menu-visible') && !headerMenu.contains(event.target)) {
        headerMenu.classList.remove('menu-visible');
    }
});