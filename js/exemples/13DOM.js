"use strict";
let h1 = document.getElementById("first-title");
console.log(`h1`, h1);
console.log(h1.constructor.name);

// Test de la propriété align
h1.align = "center";

// Test de la propriété hidden
//h1.hidden = true;

/* h1.animate(
  [
    // étapes/keyframes
    { transform: "translateY(0px)" },
    { transform: "translateY(300px)" },
  ],
  {
    // temporisation
    duration: 1000,
    iterations: Infinity,
  },
); */
console.log(h1.offsetWidth);
h1.ariaLabel = "Test";
console.log(h1.ariaLabel);

const select1 = document.getElementById("css_display");
console.log(select1.checkVisibility());
console.log(`h1 firstChild`, h1.firstChild);

/* while (h1) {
  console.log("class de h2 : ", h1.constructor.name);
  // Remonte la chaîne des prototypes
  h1 = Object.getPrototypeOf(h1);
} */

//h1.remove();
// Créer un élément du DOM
const h2 = document.createElement("h2");
// Ajouter cet élément dans l'arboresence du dom
document.body.appendChild(h2);
// Ajout de texte à mon élément du DOM h2
h2.innerText = "Titre de niveau 2";



// Création d'une section
const section = createElementInBody("section", "Texte de la section", document.body);

// Création d'un paragraphe en tant qu'enfant de la section
createElementInBody("p", "Lorem ipsum", section);

function createElementInBody(elementName, text = "", parent = document.body) {
  console.log(`parent`, parent);
  // Créer un élément du DOM
  const element = document.createElement(elementName);
  // Ajouter cet élément dans l'arboresence du dom
  parent.appendChild(element);
  // Ajout de texte à mon élément du DOM h2
  element.innerText = text;

  return element;

}