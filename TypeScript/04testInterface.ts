interface BikeInterface {
  model: string;
  size: number;
  pedal(): void;
  brake: () => void;
}

// Implémente la classe Bike stp qui implémente l'interface BikeInterface
class Bike implements BikeInterface {
  model: string;
  size: number;
  constructor(model: string, size: number) {
    this.model = model;
    this.size = size;
  }

  pedal() {
    console.log(`pedal`);
  }
  brake() {
    console.log(`brake`);
  }
}
