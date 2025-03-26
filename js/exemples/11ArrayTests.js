const toto = { name: "toto" };
const titi = toto;// titi et toto sont ont une valeur stockée à la même adresse mémoire (référence)
const fruits = ['Apple', 'Banana', toto];
console.log(fruits);
console.log(fruits.length);
const result = fruits.push("Blueberry")
console.log("retour de push : ", result);
console.log(fruits);

// Afficher Blueberry dans la console
console.log(fruits[2]);

// Boucler sur un tableau pour afficher chaque élément
fruits.forEach((fruit, index) => { console.log(fruit, index); })

console.log(fruits.pop());
console.log(fruits);

fruits.indexOf("Apple");
console.log(fruits.indexOf("Apple"));
console.log("Index de l'objet toto dans le tableau fruits : ", fruits.indexOf(toto));
console.log("Index de l'objet titi dans le tableau fruits : ", fruits.indexOf(titi));




if (toto === titi) {
  console.log(`toto est égal à titi`);
} else {
  console.log(`toto n'est pas égal à titi`);
}