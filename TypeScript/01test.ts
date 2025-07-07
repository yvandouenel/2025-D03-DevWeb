let i: number = 12;
console.log(`i`, i);

function test(message: string): string {
  return "Hello " + message;
}

console.log(test("Bob"));

let done: boolean = true;

const fruits: string[] = ["Banane", "Fraise"];

// Tuples
const point: [number, number] = [1, 2];

const specialArray: [boolean, number | string, number] = [true, "Hello", 12];

//Enum

enum Color {
  Blue,
  Red,
  Green,
}
const myColorIndex: Color = Color.Red;
console.log(`myColor`, myColorIndex);

let hello = "Hello World"; // Inférence - type donné dynamiquement mais qui n'est plus modifiable
hello = "qsdfqsdf";

let helloAny: any = "Hello Any";
helloAny = 12;
