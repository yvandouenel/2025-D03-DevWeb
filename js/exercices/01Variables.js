let mystere1 = 42;
let huit = "8";
// Concaténation ou addition
console.log(parseInt("8") + mystere1);
console.log(+huit + mystere1);
console.log(typeof (parseInt("8") + mystere1));

const word1 = "Hello";
const word2 = "World";
// concaténation
console.log(word1 + word2);


let mystere2 = false;
mystere2 = mystere2 + 1;
console.log(`mystere2`, mystere2);

let mystere3 = "5";
mystere3 = mystere3 * 3;
console.log(`mystere3`, mystere3);

{
  var i = 5;
  var j = 12;
  console.log("valeur de i dans le bloc : " + i);
  console.log("valeur de j dans le bloc : " + j);
}
console.log("valeur de i dans le contexte d'exécution global : " + i);
console.log("valeur de j dans le contexte d'exécution global : " + j);