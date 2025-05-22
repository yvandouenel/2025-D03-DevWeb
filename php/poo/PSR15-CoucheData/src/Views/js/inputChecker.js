function checkPassword(password) {
  let conditionsNotMet = [];

  // Vérifie si le mot de passe contient au moins une minuscule
  if (! /[a-z]/.test(password)) {
    conditionsNotMet.push('minuscule');
  }

  // Vérifie si le mot de passe contient au moins une majuscule
  if (!/[A-Z]/.test(password)) {
    conditionsNotMet.push('majuscule');
  }

  // Vérifie si le mot de passe contient au moins un caractère spécial
  if (!/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>/?]/.test(password)) {
    conditionsNotMet.push('caractère spécial');
  }

  // Vérifie si le mot de passe contient au moins un chiffre
  if (!/\d/.test(password)) {
    conditionsNotMet.push('chiffre');
  }
  console.log(conditionsNotMet);
  // Transformation du tableau conditionsNotMet en message compréhensible d'erreur
  let errorMsg = errorMessageText(conditionsNotMet);
  // Ecriture dans le div error-message
  document.getElementById("error-message").innerHTML = errorMsg;
  return conditionsNotMet;
}
function errorMessageText(conditionsNotMet) {
  let errorMsg = "";
  // Parcours du tableau
  conditionsNotMet.forEach(error => {
    errorMsg += '<li>' + error + '</li>';
  });
  return errorMsg;
}