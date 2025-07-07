"use strict";
// Implémente la classe Bike stp qui implémente l'interface BikeInterface
class Bike {
    constructor(model, size) {
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
