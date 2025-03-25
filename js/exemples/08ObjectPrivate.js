class Person {
  #name; // propriété privée
  constructor(name) {
    this.#name = name;
  }
  get name() {

    return this.#name;
  }
  set name(new_name) {
    // Traitement ici pour vérifier que l'utilisateur a bien le droit de modifier cette propriété name
    this.#name = new_name;
  }
}
const b = new Person("Bob");
console.log(b.name);
b.name = "toto";
console.log(b.name);