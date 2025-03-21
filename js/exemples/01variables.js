"use strict";
/* Déclaration (const, let, var) d'une variable et assignation (=) d'une valeur */
/* Cette première variable a une porté globale car elle n'est pas déclarée dans une fonction ou un bloc de code */
/* En javascript, le typage est dynamique donc cette variable est de type "string" car on lui a assigné une chaîne de caractères */
let test = "Valeur de la variable test";

// on demande à afficher une chaine de caractères suivi de la valeur de la variable
console.log(`test : `, test);
console.log(`type de la variable test : `, typeof (test));

test = 12;
// on demande à afficher une chaine de caractères suivi de la valeur de la variable
console.log(`test : `, test);
// on affiche le type de la variable
console.log(`type de la variable test : `, typeof (test));

test = true;
// on demande à afficher une chaine de caractères suivi de la valeur de la variable
console.log(`test : `, test);
// on affiche le type de la variable
console.log(`type de la variable test : `, typeof (test));

test = undefined;
// on demande à afficher une chaine de caractères suivi de la valeur de la variable
console.log(`test : `, test);
// on affiche le type de la variable
console.log(`type de la variable test : `, typeof (test));

test = null;
// on demande à afficher une chaine de caractères suivi de la valeur de la variable
console.log(`test : `, test);
// on affiche le type de la variable
console.log(`type de la variable test : `, typeof (test));

/* {} Ceci est un bloc de code */
{

  console.log(`test dans le bloc de code : `, test);
  console.log(`type de la variable test dans le bloc de code : `, typeof (test));
  let x = 20;
  console.log(`x dans le bloc de code : `, x);
}

console.log(`test : `, test);
// on affiche le type de la variable
console.log(`type de la variable test : `, typeof (test));
x = 20;
console.log(`x dans le bloc de code : `, x);
