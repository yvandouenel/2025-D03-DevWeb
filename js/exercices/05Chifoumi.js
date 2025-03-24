// Tirage au sort
function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

// randomGame sera égal à  1 ou 2 ou 3
// Par convention 1 - Pierre, 2 - Feuille, 3 - Ciseaux
const randomGame = getRandomInt(3) + 1;
console.log(`randomGame`, randomGame);

// Demander le choix de l'utilisateur
let userGame = window.prompt("Faites votre choix (1 - Pierre, 2 - Feuille, 3 - Ciseaux");
console.log(`userGame`, userGame);
// Traitement du résultat
// Match nul
if (userGame == randomGame) {
  console.log(`Match nul`);
}




