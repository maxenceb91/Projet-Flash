document.addEventListener("DOMContentLoaded", () => {
    const grid = document.querySelector(".grid");

    const card = document.createElement("img");
    card.src = "/Projet-flash/assets/img/memory_card.png";
    card.alt = "A card";

    grid.appendChild(card);
});