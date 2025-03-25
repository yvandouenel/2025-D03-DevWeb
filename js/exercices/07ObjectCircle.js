function Circle(radius, name) {
  this.radius = radius;
  this.name = name;
}
Circle.prototype.area = function () {
  console.log(`Aire de ${this.name} : `, this.pi * this.radius ** 2);
}
Circle.prototype.pi = Math.PI;

/* class Circle {
  static pi = Math.PI;
  constructor(radius, name) {
    this.radius = radius;
    this.name = name;
  }
  area() {
    console.log(`Aire de ${this.name} : `, Circle.pi * this.radius ** 2);
  }
} */


const smallCircle = new Circle(2, "Petit cercle");
console.log(`smallCircle`, smallCircle);
const bigCircle = new Circle(4, "Grand cercle");

smallCircle.area();
bigCircle.area();
if (smallCircle.hasOwnProperty("radius")) {
  console.log("smallCircle a 'radius' comme propriété directe");
} else {
  console.log("smallCircle n'a pas 'radius' comme propriété directe");

};