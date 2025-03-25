function Car(br, mo, ye, co) {
  this.brand = br;
  this.model = mo;
  this.year = ye;
  this.color = co;
}

Car.prototype.start = function () {
  console.log(`this`, this);
  console.log(`La ${this.brand} ${this.model} démarre`);
}
Car.prototype.stop = function () {
  console.log(`La ${this.brand} ${this.model} s'arrête`);
}

// Création de l'instance via l'appel du constructeur en utilisant le mot clé "new"
const yaris = new Car("Toyota", "Yaris", 2020, "blanc");
const clio = new Car("Renault", "Clio", 2016, "noir");
console.log(`yaris`, yaris);
console.log(`clio`, clio);

yaris.start();
yaris.stop();

clio.start();
clio.stop();

console.log(`this`, this);
