const headerMenu = document.querySelector(".menu");
const test = document.querySelector(".pp-menu");
const main = document.querySelector("main");
const burgerMenu = document.querySelector(".burger-menu");
const burger = document.querySelector(".burger");
const span1 = document.querySelector(".span-1");
const span2 = document.querySelector(".span-2");
const span3 = document.querySelector(".span-3");

test.addEventListener('click', (event) => {
    headerMenu.classList.toggle('menu-visible');
    event.stopPropagation();
});

document.addEventListener('click', (event) => {
    if (headerMenu.classList.contains('menu-visible') && !headerMenu.contains(event.target)) {
        headerMenu.classList.remove('menu-visible');
    }
});

burgerMenu.addEventListener('click', () => {
    burgerMenu.classList.toggle('active');
    burger.classList.toggle('burger-active')
});