const people = [
  { name: "Bob", age: 72 },
  { name: "Léa", age: 8 },
  { name: "Simone", age: 89 },
]

/* A l'aide de la méthode sort, classer people par ordre croissant d'age des objets littéraux qui le composent.
Aidez de la documenation et/ou de l'IA pour m'expliquer comment cela fonctionne 

Vous avez 10mn, correction à 11h35
*/
// Classement unicode 
const chiffres = [1, 2, 85, 58, 3, 78, 9];
console.log(chiffres.sort(function (a, b) {

  console.log(`a`, a);
  console.log(`b`, b);
  return a - b;

}));

console.log(people.sort(function (a, b) {
  return a.age - b.age;
}));

// Copy d'un tableau
// quand on assigne à une variable une autre variable d'un type évolué, on ne copie pas les données mais l'adresse (la référence)
// On appelle cela une copie par référence
//const persons = people;

// Copie des valeurs en utilisant le spread operator
const persons = [...people];

persons.push({ name: "Toto", age: 51 });
console.log(`persons`, persons);
console.log(`people`, people);



