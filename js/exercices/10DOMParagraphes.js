// Ajout d'un élément du DOM bouton dans le body via (ou pas) la fonction createCustomElement
const button = createCustomElement("button", "Ajouter un paragraphe");

// Ajout d'un élément du DOM section dans le body via (ou pas) la fonction createCustomElement
const section = createCustomElement("section");

// Ajouter un "event listener" qui sera appelé lors du clic sur le l'élément du DOM "bouton"
button.addEventListener("click", (event) => {
  // Dans la fonction d'event listener, créer un nouvel élément du DOM "paragraphe" qui sera ajouté en dernier enfant de l'élément du DOM "section"
  createCustomElement("p", "Lorem ipsum", section);
})



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