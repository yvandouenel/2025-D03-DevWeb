// Fonction constructeur
function Pokemon(name, type, level) {
  this.name = name;
  this.type = type;
  this.level = level;

}

// Utilisation du prototype du constructeur
Pokemon.prototype.fight = function (otherPokemon) {
  const myPoints = Math.random() * this.level;
  const otherPokemonPoints = Math.random() * otherPokemon.level;
  console.log(`Points de ${this.name} : ${myPoints} et points de ${otherPokemon.name}: ${otherPokemonPoints}`);
  if (myPoints >= otherPokemonPoints) {
    console.log(`Bravo ` + this.name + ', tu as gagné contre ' + otherPokemon.name);
  } else {
    console.log(`Désolé ` + this.name + ', tu as perdu contre ' + otherPokemon.name);
  }
}

// Création des instance de Pokemon
const tadmorv = new Pokemon("Tadmorv", "Poison", 32);
console.log(`tadmorv`, tadmorv);

const pikachu = new Pokemon("Pikachu", "Electricité", 89);

console.log(`pikachu`, pikachu);

// tadmorv combat pikachu via l'appel de la méthode fight
tadmorv.fight(pikachu);