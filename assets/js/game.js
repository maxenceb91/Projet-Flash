const grid = document.querySelector(".grid");
const sizeSelect = document.getElementById("size");
const generateBtn = document.querySelector(".parameters button");
function generateGrid() {
  const selectedSize = sizeSelect.value;
  
  grid.innerHTML = "";

  grid.classList.remove("grid-4", "grid-6", "grid-10");
  
  let cardCount;
  let gridClass;
  
  switch(selectedSize) {
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

generateBtn.addEventListener("click", generateGrid);

generateGrid();