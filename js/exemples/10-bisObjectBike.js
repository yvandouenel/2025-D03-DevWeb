//création d'un objet
class Bike {
  #brand;
  #model;
  #color;
  #type;
  #distance;
  //création du constructeur
  constructor(brand, model, color, type) {
    this.#brand = brand;
    this.#model = model;
    this.#color = color;
    this.#type = type;
    this.#distance = 0;
  }
  //création d'une fonction
  ride(km) {
    this.#distance = this.#distance + km;
    console.log(
      `Je roule pendant ${km} km et en tout, j'ai roulé ${this.#distance} km`
    );
  }
}
// Instantiacion d'un vélo
const bikeone = new Bike(`titane`, `v22`, `bleu`, `vtc`); // instantiacion avec "new" qui fait appel au constructeur
bikeone.ride(56); // appel de la fonction
bikeone.ride(23);

class Ebike extends Bike {
  #motor;
  #battery;
  constructor(brand, model, color, type, motor, battery) {
    super(brand, model, color, type); // super --> faire appel à la classe supérieure de "Bike" et donc ses propriétés
    this.#motor = motor;
    this.#battery = battery;
  }
  ride(km) {
    super.ride(km);
    console.log(
      `J'ai roulé à l'éléctricité avec mon moteur ${this.#motor.name
      } de puissance ${this.#motor.power} et de la marque ${this.#motor.brand
      } et grâce à ma batterie ${this.#battery}`
    );
  }
}
const motor1 = {
  name: `v12`,
  power: 250,
  brand: `bosch`,
};
const ebike = new Ebike(`Yamaha`, `Beau`, `blanc`, `vtt`, motor1, `duracel`);
ebike.ride(12);
ebike.ride(45);
