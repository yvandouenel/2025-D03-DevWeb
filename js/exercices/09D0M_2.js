function createCustomElement(elementName, text = "", parent = document.body) {
  console.log(`parent`, parent);
  // Créer un élément du DOM
  const element = document.createElement(elementName);
  // Ajouter cet élément dans l'arboresence du dom
  parent.appendChild(element);
  // Ajout de texte à mon élément du DOM h2
  element.innerText = text;

  return element;

}
const p = createCustomElement("p", "Loremipsum qsdfqsdf qsdfqsdf sdf qsdfqs fqs qsa erazetr sdfzsdf sdfqs");
p.style.width = "25%";
p.style.border = "1px solid black";

p.animate(
  [
    // étapes/keyframes
    { transform: "translateX(0px)", offset: 0 },
    { fontSize: "1rem", offset: 0 },
    { transform: "translateX(300%)", offset: 0.67 },
    { fontSize: "2rem", offset: 0.67 },
    { transform: "translateX(0px)", offset: 1 },
    { fontSize: "1rem", offset: 1 },
  ],
  {
    // temporisation
    duration: 3000,
  },
);