// Déclaration des fonctions de calcul
function add(a, b) {
  return parseInt(a) + parseInt(b);
}
function substract(a, b) {
  return parseInt(a) - parseInt(b);
}
function multiply(a, b) {
  return parseInt(a) * parseInt(b);
}
function division(a, b) {
  return parseInt(a) / parseInt(b);
}

// Tant que l'utilisateur n'a pas entré 5 à la question de l'opération, 
// je continue de lui demander quelle opération il veut traiter
let operation = window.prompt("Quelle opération souhaitez vous faire ? (1 : addition, 2: soustraction, 3 - multiplication, 4 - division, 5 - sortie)");

while (operation != 5) {
  const numberOne = window.prompt("Entrez un premier nombre");
  const numberTwo = window.prompt("Entrez un second nombre");

  console.log(`Vous avez entré deux nombres : `, numberOne, numberTwo);


  // appeler la bonne fonction suivant l'opération choisie par l'utilisateur 
  if (operation == 1) {
    //  Appel de la fonction add et stockage du retour 
    const sum = add(numberOne, numberTwo);

    // Affichage du résultat
    console.log(`Résultat de l'opération`, sum);
  } else if (operation == 2) {
    //  Appel de la fonction substract et stockage du retour
    const diff = substract(numberOne, numberTwo);

    // Affichage du résultat
    console.log(`Résultat de l'opération`, diff);
  }
  else if (operation == 3) {
    //  Appel de la fonction substract et stockage du retour
    const product = multiply(numberOne, numberTwo);

    // Affichage du résultat
    console.log(`Résultat de l'opération`, product);
  }
  else if (operation == 4) {
    //  Appel de la fonction substract et stockage du retour
    const quotient = division(numberOne, numberTwo);

    // Affichage du résultat
    console.log(`Résultat de l'opération`, quotient);
  }
  // Changement éventuel de la valeur de la variable globale operation
  operation = window.prompt("Quelle opération souhaitez vous faire ? (1 : addition, 2: soustraction, 3 - multiplication, 4 - division, 5 - sortie)");

}
console.log(`Vous avez souhaité sortir de la calculatrice`);
