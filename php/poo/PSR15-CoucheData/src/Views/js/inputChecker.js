/**
 * Compare les différentes conditions (minuscule, majuscule, ...) à false et alimente le tableau conditionsNotMet le cas échéant
 * Fait appel à la fonction errorMessageText
 * @param {String} password 
 * @returns void
 */
function checkPassword(password) {

  let conditionsNotMet = [];
  if (password.length < 12) {
    conditionsNotMet.push('Minimum 12 caractères');
  }
  if (!/[a-z]/.test(password)) {
    conditionsNotMet.push('Au moins une minuscule');
  }
  if (!/[A-Z]/.test(password)) {
    conditionsNotMet.push('Au moins une majuscule');
  }
  if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>/?]/.test(password)) {
    conditionsNotMet.push('Au moins un caractère spécial');
  }
  if (!/\d/.test(password)) {
    conditionsNotMet.push('Au moins un chiffre');
  }


  // Transformation du tableau conditionsNotMet en message compréhensible d'erreur
  let errorMsg = errorMessageText(conditionsNotMet);
  // Ecriture dans le div error-message
  document.getElementById("error-message").innerHTML = errorMsg;
}
/**
 * Parcours le tableau conditionsNotMet et
 * @param {Array} conditionsNotMet 
 * @returns {String}
 */
function errorMessageText(conditionsNotMet) {
  let errorMsg = "";
  // Parcours du tableau
  conditionsNotMet.forEach(error => {
    errorMsg += '<li>' + error + '</li>';
  });
  return errorMsg;
}