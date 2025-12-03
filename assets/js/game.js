const grid = document.querySelector(".grid");
const sizeSelect = document.getElementById("size");
const generateBtn = document.querySelector(".parameters button");
const cards = [];
let wait = false;
let start = false;

class Card {
    constructor(element, hideImage, flipImage) {
        this.element = element;
        this.hideImage = hideImage;
        this.flipImage = flipImage;
        this.isFlipped = false;
        this.isFind = false;
    }

    flip() {
        this.isFlipped = true;
        this.element.src = this.flipImage;
    }

    hide() {
        this.isFlipped = false;
        this.element.src = this.hideImage;
    }
}

// Grille
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

    let images = [
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/html5/html5-original.svg",
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/css3/css3-original.svg",
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/javascript/javascript-original.svg",
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/java/java-original.svg",
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/azuresqldatabase/azuresqldatabase-original.svg",
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/python/python-original.svg",
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg",
        "https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg"
    ];

    images = images.concat(images);

    cards.length = 0;

    for (let i = 0; i < cardCount; i++) {
        const hideImage = "/Projet-flash/assets/img/card.png";
        const index = Math.floor(Math.random() * images.length);
        const flipImage = images[index];
        images.splice(index, 1);

        const cardElement = document.createElement("img");
        cardElement.src = hideImage;
        cardElement.classList.add("memory-card");
        grid.appendChild(cardElement);

        const cardObj = new Card(cardElement, hideImage, flipImage);
        cards.push(cardObj);

        cardElement.addEventListener("click", () => {
            if (!start || wait) return;
            if (cardObj.isFlipped || cardObj.isFind) return;
            cardObj.flip();
            setTimeout(() => {
                const flippedCards = cards.filter(c => c.isFlipped && !c.isFind);

                if (flippedCards.length === 2) {
                    if (flippedCards[0].flipImage === flippedCards[1].flipImage) {
                        flippedCards.forEach(c => c.isFind = true);
                        if (cards.every(c => c.isFind)) {
                            alert("Félicitations ! Vous avez trouvé toutes les paires ! (" + timeFormat(time) + ")");
                            clearInterval(timerInterval);
                            start = false;
                        }
                    } else {
                        wait = true;
                        setTimeout(() => {
                            flippedCards.forEach(c => c.hide());
                            wait = false;
                        }, 500);
                    }
                }
            }, 50);
        });
    }
}

// Chrono
let startTime;
let chrono;
let timerInterval;

let time = 0;

function timeFormat(ms) {
    const totalSeconds = Math.floor(ms / 1000);
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    const milliseconds = ms % 1000;
    return `${minutes}m ${seconds}s ${milliseconds}ms`;
}

generateBtn.addEventListener("click", () => {
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
});

generateGrid();