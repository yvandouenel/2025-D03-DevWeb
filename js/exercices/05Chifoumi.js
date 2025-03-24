// Tirage au sort
function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

// randomGame sera égal à  1 ou 2 ou 3
// Par convention 1 - Pierre, 2 - Feuille, 3 - Ciseaux
const randomGame = getRandomInt(3) + 1;
if (randomGame == 1) {
  console.log(`randomGame : Pierre`);
} else if (randomGame == 2) {
  console.log(`randomGame : Feuille`);
}
else if (randomGame == 3) {
  console.log(`randomGame : Ciseaux`);
}

// Demander le choix de l'utilisateur
let userGame = window.prompt("Faites votre choix (1 - Pierre, 2 - Feuille, 3 - Ciseaux");
if (userGame == 1) {
  console.log(`userGame : Pierre`);
} else if (userGame == 2) {
  console.log(`userGame : Feuille`);
}
else if (userGame == 3) {
  console.log(`userGame : Ciseaux`);
}
// Traitement du résultat
// Match nul
if (userGame == randomGame) {
  console.log(`Match nul`);
} else {
  // Je gère tous les cas gagnants pour l'utilisateur
  if (userGame == 1 && randomGame == 3 || userGame == 2 && randomGame == 1 || userGame == 3 && randomGame == 2) {
    console.log(`Vous avez gagné`);
  }
  else {
    console.log(`Vous avez perdu`);
  }
}






