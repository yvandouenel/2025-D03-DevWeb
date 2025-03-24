// Déclaration d'une fonction avec un paramètre
function alcess(message) {
  // Que fait cette fonction ?
  console.log(`Maitenant que vous m'avez appelée, vous êtes heureux ` + message);

  // Que renvoie cette fonction
  return "Du bonheur";
}

// Appel de la fonction avec un argument et stockage de son retour
let result = alcess(", n'est-ce pas ?");

console.log(`result = `, result);

const add = (a, b) => a + b;
console.log(add(5, 8));

// Fonction immédiate anonyme
(function () {
  // Permet d'isoler les variables et fonctions à l'intérieur de la fonction
  console.log(`Cette fonction s'appelle immédiatement `);
  const toto = "toto"
  console.log(`toto`, toto);
})();

// Closure
const getPrivateVariable = (function () {
  // Permet d'isoler les variables et fonctions à l'intérieur de la fonction
  const privateVariable = "Hello";
  function getPrivateVariable() {
    return privateVariable;
  }
  return getPrivateVariable;
})();
// ReferenceError: privateVariable is not defined
// console.log(`privateVariable`, privateVariable);

// Comment donner un accès à privateVariable dans le scope global ?

console.log(getPrivateVariable());

// fonction récursive, une fonction qui s'appelle elle-même
function factoriel(n) {
  if (n == 1) {
    return 1
  }
  return n * factoriel(n - 1);
}
console.log(factoriel(5));
function sumFact(n) {
  if (n == 0) {
    return 0
  }
  return n + sumFact(n - 1);
}
// Suite de Fibonacci 0 1 1 2 3 5 8 13 31  
function fib(n) {
  if (n == 0) {
    return 0
  } else if (n == 1) {
    return 1
  } else return fib(n - 1) + fib(n - 2);
}

console.log(fib(6));



