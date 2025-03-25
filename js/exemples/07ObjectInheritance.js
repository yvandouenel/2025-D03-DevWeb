class Pokemon {
  constructor(name, level, type) {
    this.name = name;
    this.level = level;
    this.type = type;
  }
  fight(otherPokemon) {
    const thisPoints = Math.random() * this.level;
    const otherPoints = Math.random() * otherPokemon.level;
    if (thisPoints >= otherPoints) {
      console.log(`Bravo ${this.name} grace à ton score de ${thisPoints}, tu as gagné contre ${otherPokemon.name} (score de ${otherPoints})`);
    } else { console.log(`Désolé ${this.name} à cause de ton pauvre score de ${thisPoints}, tu as perdu contre ${otherPokemon.name} (score de ${otherPoints})`); }

  }
}

const tadmorv = new Pokemon("Tadmorv", 42, 'Poison');
const pikachu = new Pokemon("Pikachu", 55, 'Electricité');

//tadmorv.fight(pikachu);

class DoblePokemon extends Pokemon {
  constructor(name, level, type, secondType) {
    super(name, level, type);
    this.secondType = secondType;
  }
  fight(otherPokemon) {
    const thisPoints = Math.random() * this.level * 1.1;
    const otherPoints = Math.random() * otherPokemon.level;
    if (thisPoints >= otherPoints) {
      console.log(`Bravo ${this.name} grace à ton score de ${thisPoints} calculé avec un apport de 10%, tu as gagné contre ${otherPokemon.name} (score de ${otherPoints})`);
    } else { console.log(`Désolé ${this.name} à cause de ton pauvre score de ${thisPoints} et malgré l'apport de 10%, tu as perdu contre ${otherPokemon.name} (score de ${otherPoints})`); }

  }
}
const doblePikachu = new DoblePokemon("DoblePikachu", 58, 'Electricité');
doblePikachu.fight(pikachu);
//pikachu.fight(doublePikachu);



