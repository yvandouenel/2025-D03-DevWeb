export default class Task {
  constructor(name, done) {
    this.name = name;
    this.done = done;

    // Appel du render pour viusaliser la tâche
    this.domElements = this.render();

    // Gestion des événements
    this.handleEvents();
  }
  render() {
    // Création de la section qui "wrappe" toute la tâche
    const section = this.createCustomElement("section");
    const h2 = this.createCustomElement("h2", this.name, section);
    if (this.done) { h2.style.textDecoration = "line-through"; }
    const textValidate = this.done ? "Invalider" : "Valider";
    const buttonValidate = this.createCustomElement("button", textValidate, section);
    const buttonDelete = this.createCustomElement("button", "Delete", section);

    return {
      section: section,
      h2: h2,
      buttonValidate: buttonValidate,
      buttonDelete, buttonDelete
    }
  }

  handleEvents() {
    this.domElements.buttonDelete.addEventListener("click", (event) => {
      this.delete();
    });


    this.domElements.buttonValidate.addEventListener("click", (event) => {
      this.done = !this.done;
      // Je dois "barrer" le titre qui correspond au nom de la tâche le cas échéant et changer le label du bouton valider
      if (this.done) {
        this.domElements.h2.style.textDecoration = "line-through";
        this.domElements.buttonValidate.innerText = "Invalider";
      } else {
        this.domElements.h2.style.textDecoration = "none";
        this.domElements.buttonValidate.innerText = "Valider";
      }
    });

  }
  delete() {
    this.domElements.section.remove();
  }
  createCustomElement(elementName, text = "", parent = document.body) {
    console.log(`parent`, parent);
    // Créer un élément du DOM
    const element = document.createElement(elementName);
    // Ajouter cet élément dans l'arboresence du dom
    parent.appendChild(element);
    // Ajout de texte à mon élément du DOM h2
    element.innerText = text;

    return element;

  }
}