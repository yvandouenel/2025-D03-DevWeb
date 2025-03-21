/**
 * 
 * @param {*} text 
 */
function test(text) {
  console.log(`Test `, text);

}
test("texte donné en argument");
/**
 * Fonction qui additionne les deux paramètres et qui renvoie la somme
 * @param {number} a 
 * @param {number} b 
 * @returns number
 */
function addition(a, b) {
  return a + b;
}
let result = addition(3, 2);

result = addition(12, 36);

console.log(`result `, result);

// fonction anonyme immédiate - 
// - permet d'isoler le code (ici i et j sont isolés)
// - permet d'exposer uniquement les variables que l'on veut exposer via un mécanisme de closure
const getJ = (function () {
  let i = 24;
  let j = 12;

  function getJ() {
    return j;
  }
  return getJ;
})();
console.log(`getJInAnonymousFunction`, getJInAnonymousFunction());



