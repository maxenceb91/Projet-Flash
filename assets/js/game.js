const grid = document.querySelector(".grid");
const sizeSelect = document.getElementById("size");
const generateBtn = document.querySelector(".parameters button");

function generateGrid() {
    const selectedSize = sizeSelect.value;

    grid.innerHTML = "";

    grid.classList.remove("grid-4", "grid-6", "grid-10");

    let cardCount;
    let gridClass;

    switch (selectedSize) {
        case "4x4":
            cardCount = 16;
            gridClass = "grid-4";
            break;
        case "6x6":
            cardCount = 36;
            gridClass = "grid-6";
            break;
        case "10x10":
            cardCount = 100;
            gridClass = "grid-10";
            break;
        default:
            cardCount = 16;
            gridClass = "grid-4";
    }

    grid.classList.add(gridClass);

    for (let i = 0; i < cardCount; i++) {
        const card = document.createElement("img");
        card.src = "/Projet-flash/assets/img/memory_card.jpg";
        card.alt = "A card";
        card.classList.add("memory-card");
        grid.appendChild(card);
    }

    console.log(`Grille ${selectedSize} générée avec ${cardCount} cartes`);
}

let startTime;
let chrono;
let timerInterval;

function timeFormat(ms) {
    const totalSeconds = Math.floor(ms / 1000);
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    const milliseconds = ms % 1000;
    return `${minutes}m ${seconds}s ${milliseconds}ms`;
}

generateBtn.addEventListener("click", () => {
    generateGrid();

    if (!chrono) {
        chrono = document.createElement("p");
        document.querySelector(".game").appendChild(chrono);
    }

    startTime = Date.now();

    if (timerInterval) clearInterval(timerInterval);

    timerInterval = setInterval(() => {
        const elapsed = Date.now() - startTime;
        chrono.innerHTML = `<i class="ri-timer-line"></i> Chronomètre: ${timeFormat(elapsed)}`;
    }, 10);
});

generateGrid();