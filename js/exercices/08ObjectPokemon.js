
class Pokemon {

  // Private properties
  #name; // name of the Pokémon
  #hp; // points de vie
  #level; // niveau
  #type; // essence élémentaire du Pokemon

  constructor(name, hp, level, type) {
    this.#name = name;
    this.#hp = hp;
    this.#level = level;
    this.#type = type;
  }

  static log(message) {
    const format = `\n--------------\n${message}\n--------------\n`
    console.log(format);
  }

  // Getter/Setter of privates properties
  get name() {
    console.log(`Dans get name`);
    return this.#name;
  }
  set name(newname) {
    console.log(`Dans set name`);
    this.#name = newname;
  }
  get hp() {
    return this.#hp;
  }
  set hp(newhp) {
    if (this.hp < 0) return // HP can't be negative
    this.#hp = newhp;
  }
  get level() {
    return this.#level;
  }
  set level(newlevel) {
    this.#level = newlevel;
  }
  get type() {
    return this.#type;
  }
  set type(newtype) {
    this.#type = newtype;
  }

  info() {
    const info = `Pokemon Info\n--------------\nName: ${this.name}\nType: ${this.type}\nLevel: ${this.level}\nHP: ${this.hp}`;
    return Pokemon.log(info)
  }

  attack(opponentPokemon) {
    const log = `${this.name} a attaqué ${opponentPokemon.name} !`
    return Pokemon.log(log)
  }
}
const pikachu = new Pokemon("Pikachu", 5, 1, "Electrique");
console.log(pikachu.name);
pikachu.name = "Toto";
console.log(pikachu.name);
pikachu.info();


class FirePokemon extends Pokemon {
  constructor(name, hp, level) {
    super(name, hp, level);
    this.type = "Fire";
  }

  attack(opponentPokemon) {
    super.attack(opponentPokemon);
    if (opponentPokemon.type === "Grass") {
      // On enlève 2 points de dégats car feu > plante
      opponentPokemon.hp -= 2;
    } else if (opponentPokemon.type === "Water") {
      // On n'enlève qu'un demi point de dégats car feu < eau
      opponentPokemon.hp -= 0.5;
    }
  }
  /**
   * Capacité spéciale pour le type feu
   * Dans le cas où les points de vie sont faibles (<5), alors on enlève 3 points de vie à l'opposant
   * @param {Pokemon} opponentPokemon 
   * @return void
   */
  blazeAbility(opponentPokemon) {
    if (this.hp < 5) {
      opponentPokemon.hp -= 3;
    }
  }
  /**
   * Méthode qui permet au pokemon de crier
   *  @return void
   */
  cry() {
    const cry = "Ah"
    console.log(cry);
  }
}

class WaterPokemon extends Pokemon {
  constructor(name, hp, level) {
    super(name, hp, level);
    this.type = "Water";
  }

  attack(opponentPokemon) {
    super.attack(opponentPokemon)
    if (opponentPokemon.type === "Fire") {
      opponentPokemon.hp -= 2;
    } else if (opponentPokemon.type === "Grass") {
      opponentPokemon.hp -= 0.5;
    }
  }
  /**
   * Dans le cas où les points de vie sont faibles (<5), cette méthode permet d'ajouter 3 points de vie
   * @return void
   */
  torrentAbility() {
    if (this.hp < 5) {
      this.hp += 3;
    }
  }

  cry() {
    const cry = "oh";
    Pokemon.log(cry)
  }
}

class GrassPokemon extends Pokemon {
  constructor(name, hp, level) {
    super(name, hp, level);
    this.type = "Grass";
  }

  attack(opponentPokemon) {
    super.attack(opponentPokemon)
    if (opponentPokemon.type === "Water") {
      opponentPokemon.hp -= 2;
    } else if (opponentPokemon.type === "Fire") {
      opponentPokemon.hp -= 0.5;
    }
  }
  /**
   * Quand il faut beau, ajoute un point de vie
   */
  photosynthesis() {
    this.hp += 1;
  }

  cry() {
    const cry = "Uh";
    console.log(cry);
  }
}

class Trainer {
  #name;
  #squad;

  constructor(name, squad) {
    this.#name = name;
    this.#squad = squad;
  }

  get name() {
    return this.#name;
  }
  set name(newname) {
    this.#name = newname;
  }
  get squad() {
    return this.#squad;
  }
  set squad(newsquad) {
    this.#squad = newsquad;
  }

  add_tosquad(Pokemon) {
    return this.squad.push(Pokemon);
  }
}

const dracofeu = new FirePokemon("DracoFeu", 8, 1);
const tortank = new WaterPokemon("Tortank", 12, 1)
const bulbasaur = new GrassPokemon("Bulbasaur", 10, 1)

dracofeu.info()