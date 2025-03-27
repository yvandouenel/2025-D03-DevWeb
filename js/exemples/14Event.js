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
  // Création d'un élément du dom comportant la flèche
  const arrow = document.createElement("span");
  arrow.innerText = " V ";
  h2.appendChild(arrow);

  // par défaut, tous les titres ont la classe "close"
  h2.classList.add("close");
  h2.addEventListener("click", () => {
    // Il faut que je retrouve l'élément du DOM qui suit h2 (paragraphe) et que je le cache ou que je l'affiche
    const p = h2.nextElementSibling;
    p.hidden = !p.hidden;
    console.log(` p.hidden : `, p.hidden);

    // En foncion de la valeur de p.hidden, je modifie la classe
    // du h2
    /* if (p.hidden) {
      console.log(`Je viens de cacher le paragraphe`);
      h2.classList.add("close");
      h2.classList.remove("open");
    } else {
      console.log(`Je viens de montrer le paragraphe`);
      h2.classList.add("open");
      h2.classList.remove("close");
    } */
    // en fonction de la valeur de p.hidden, je fais tourner la flèche dans le sens horaire ou dans le sens
    // anti horaire 
    // Ici, il que je m'adresse au span compris dans le h2
    if (p.hidden) {
      console.log(`Dans l'animation p.hidden vrai`);
      arrow.animate(
        [
          // étapes/keyframes
          { transform: "rotate(-90deg)" },
          { transform: "rotate(0deg)" },
        ],
        {
          // temporisation
          duration: 1000,
          fill: "forwards"
        },
      );
    } else {
      console.log(`Dans l'animation  p.hidden faux`);

      arrow.animate(
        [
          // étapes/keyframes
          { transform: "rotate(0deg)" },
          { transform: "rotate(-90deg)" },
        ],
        {
          // temporisation
          duration: 1000,
          fill: "forwards"
        },
      );
    }

  })
})

/* Faites en sorte que les titre de niveau 2 dont le paragraphe suivant est caché soient suivi de la flèche "v" et sinon de "x"

Faites apparaître la "main" au survol des h2
Vous pouvez utilser la pseudo class :after soit en css soit en js
Pour l'apparition de la main, utilisez la propriété cursor: pointer

*/