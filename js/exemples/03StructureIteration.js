// boucle for

/* for (let i = 0; i < 1000; i++) {
  console.log(`i : `, i);
}
  */
let j = 0;

while (j < 100) {
  j++;
  if (j == 50) {
    continue;
  }
  console.log(`j : `, j);
}