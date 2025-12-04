import { devImages, psgImages } from "./images.js";

const grid = document.querySelector(".grid");
const sizeSelect = document.getElementById("size");
const themeSelect = document.getElementById("theme");
const generateBtn = document.querySelector(".parameters button");
const cards = [];
let wait = false;
let start = false;

class Card {
    constructor(element, flipImage) {
        this.element = element;
        this.flipImage = flipImage;
        this.isFlipped = false;
        this.isFind = false;
        this.imgElement = this.element.querySelector('.face-back img');
        this.imgElement.src = flipImage;
    }

    flip() {
        this.isFlipped = true;
        this.element.classList.add('flipped');
    }

    hide() {
        this.isFlipped = false;
        this.element.classList.remove('flipped');
    }
}

function generateGrid() {
    const selectedSize = sizeSelect.value;
    const selectedTheme = themeSelect.value;
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

    const selectedImages = selectedTheme == "dev" ? devImages : psgImages;
    const cloneImages = selectedImages.slice();

    const flipImages = []
    for (let i = 0; i < cardCount / 2; i++) {
        const index = Math.floor(Math.random() * cloneImages.length);
        const flipImage = cloneImages[index];
        cloneImages.splice(index, 1)
        for (let i = 0; i < 2; i++) {
            flipImages.push(flipImage);
        }
    }

    flipImages.sort(() => Math.random() - 0.5);

    cards.length = 0;
    let i = 0;
    flipImages.forEach((flipImage) => {
        const cardContainer = document.createElement("div");
        cardContainer.classList.add("card-container");

        const cardElement = document.createElement("div");
        cardElement.classList.add("memory-card");

        const faceFront = document.createElement("div");
        faceFront.classList.add("face", "face-front");

        const faceBack = document.createElement("div");
        faceBack.classList.add("face", "face-back");
        const flipImageElement = document.createElement("img");
        faceBack.appendChild(flipImageElement);

        cardElement.appendChild(faceFront);
        cardElement.appendChild(faceBack);
        cardContainer.appendChild(cardElement);

        grid.appendChild(cardContainer);

        const cardObj = new Card(cardElement, flipImage);
        cards.push(cardObj);

        i++;

        cardContainer.addEventListener("click", () => {
            if (!start || wait) return;
            if (cardObj.isFlipped || cardObj.isFind) return;

            cardObj.flip();

            setTimeout(() => {
                const flippedCards = cards.filter(c => c.isFlipped && !c.isFind);

                if (flippedCards.length === 2) {
                    if (flippedCards[0].flipImage === flippedCards[1].flipImage) {
                        flippedCards.forEach(c => c.isFind = true);
                        if (cards.every(c => c.isFind)) {
                            clearInterval(timerInterval);
                            start = false;

                            const timeSeconds = Math.floor(time / 1000);
                            fetch("/Projet-flash/projet/utils/score.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                body:
                                    "game_id=" + encodeURIComponent(1) +
                                    "&difficulty=" + encodeURIComponent(sizeSelect.value === "4x4" ? 1 : sizeSelect.value === "6x6" ? 2 : 3) +
                                    "&score=" + encodeURIComponent(timeSeconds)
                            })
                                .then(res => res.text())

                            const replay = confirm(
                                "Félicitations ! Vous avez trouvé toutes les paires ! (" + timeFormat(time) + ")\n\nVoulez-vous rejouer ?"
                            );

                            if (replay) {
                                time = 0;
                                startGame();
                            }
                        }
                    } else {
                        wait = true;
                        setTimeout(() => {
                            flippedCards.forEach(c => c.hide());
                            wait = false;
                        }, 800);
                    }
                }
            }, 50);
        });
    });
}

let startTime;
let chrono;
let timerInterval;

let time = 0;

function timeFormat(ms) {
    const totalSeconds = Math.floor(ms / 1000);
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    const milliseconds = Math.floor((ms % 1000) / 10);
    return `${minutes}m ${seconds}s ${milliseconds}cs`;
}

generateBtn.addEventListener("click", () => {
    startGame();
});

function startGame() {
    generateGrid();
    start = true;

    if (!chrono) {
        chrono = document.createElement("p");
        document.querySelector(".game").appendChild(chrono);
    }

    startTime = Date.now();
    if (timerInterval) clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        const elapsed = Date.now() - startTime;
        time = elapsed;
        chrono.innerHTML = `<i class="ri-timer-line"></i> Chronomètre: ${timeFormat(elapsed)}`;
    }, 10);
}
