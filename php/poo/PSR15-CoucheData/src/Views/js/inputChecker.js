/**
 * Compare les différentes conditions (minuscule, majuscule, ...) à false et alimente le tableau conditionsNotMet le cas échéant
 * Fait appel à la fonction errorMessageText
 * @param {String} password 
 * @returns void
 */
function checkPassword(password) {

  let conditionsNotMet = [];
  switch (false) {
    case password.length < 12: conditionsNotMet.push('Minimum 12 caractères');
    case (/[a-z]/.test(password)): conditionsNotMet.push('Au moins une minuscule');
    case (/[A-Z]/.test(password)): conditionsNotMet.push('Au moins une majuscule');
    case (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>/?]/.test(password)): conditionsNotMet.push('Au moins un caractère spécial');
    case (/\d/.test(password)): conditionsNotMet.push('Au moins un chiffre');
  }

  // Transformation du tableau conditionsNotMet en message compréhensible d'erreur
  let errorMsg = errorMessageText(conditionsNotMet);
  // Ecriture dans le div error-message
  document.getElementById("error-message").innerHTML = errorMsg;
}
/**
 * Parcours le tableau conditionsNotMet et le transforme en chaîne de caractères
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