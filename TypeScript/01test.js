"use strict";
let i = 12;
console.log(`i`, i);
function test(message) {
    return "Hello " + message;
}
console.log(test("Bob"));
let done = true;
const fruits = ["Banane", "Fraise"];
// Tuples
const point = [1, 2];
const specialArray = [true, "Hello", 12];
//Enum
var Color;
(function (Color) {
    Color[Color["Blue"] = 0] = "Blue";
    Color[Color["Red"] = 1] = "Red";
    Color[Color["Green"] = 2] = "Green";
})(Color || (Color = {}));
const myColorIndex = Color.Red;
console.log(`myColor`, myColorIndex);
let hello = "Hello World"; // Inférence - type donné dynamiquement mais qui n'est plus modifiable
hello = "qsdfqsdf";
let helloAny = "Hello Any";
helloAny = 12;
