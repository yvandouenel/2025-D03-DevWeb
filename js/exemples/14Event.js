"mode strict";

// Je cache les paragraphes
const ps = document.querySelectorAll("p");
ps.forEach((p) => {
  p.hidden = true;
})

// Récupération de la liste des h2
const h2s = document.querySelectorAll("h2");
// Ajout d'un event listener sur chaque h2
h2s.forEach((h2) => {
  h2.addEventListener("click", () => {
    // Il faut que je retrouve l'élément du DOM qui suit h2 (paragraphe) et que je le cache ou que je l'affiche
    const p = h2.nextElementSibling;
    p.hidden = !p.hidden;
  })
})

/* Faites en sorte que les titre de niveau 2 dont le paragraphe suivant est caché soient suivi de la flèche "v"et sinon de "x"

Faites apparaître la "main" au survol des h2
Vous pouvez utilser la pseudo class :after soit en css soit en js
Pour l'apparition de la main, utilisez la propriété cursor: pointer

*/