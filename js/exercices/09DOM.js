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
// Création du header
const header = createCustomElement("header");
const nav = createCustomElement("nav", "", header);


for (let i = 0; i < 4; i++) {
  const button = createCustomElement("button", `Item ${i + 1}`, nav);
}

document.querySelector("nav button:nth-child(3)").style.color = "red";
