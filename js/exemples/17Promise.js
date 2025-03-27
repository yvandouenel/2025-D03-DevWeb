// Promesse pour récupérer un token

function getToken() {
  return new Promise((resolved, reject) => {
    setTimeout(() => {
      if (Math.random() > 0.5) {
        // cas favorable
        resolved("OSDFLSDKJSDILSDdsssqdfuierSDSQErjusdfoishdfoiazsrf");
      } else {
        // Cas défavorable
        reject(new Error("Pas de token, fieu"))
      }
    }, 1000)
  })
}
function getUser(token) {
  console.log(`token dans getUser`, token);

  return new Promise((resolved, reject) => {
    console.log(`token dans getUser et dans la promesse`, token, typeof (token));
    if (token == "OSDFLSDKJSDILSDdsssqdfuierSDSQErjusdfoishdfoiazsrf") {
      setTimeout(() => {
        if (Math.random() > 0.5) {
          // cas favorable
          resolved({
            name: "Toto",
            id: 5698
          });
        } else {
          // Cas défavorable
          reject(new Error("Pas d'utilisateur, fieu"))
        }
      }, 1000)
    } else reject(new Error("Token invalide, fieu"))

  })
}

// Appel de la fonction qui renvoie une promesse
const promise = getToken()
  .then((token) => {
    console.log(`token`, token);
    return getUser(token);
  })
  .then((user) => {
    console.log(`user`, user);
  })
  .catch(error => {
    console.error(`Erreur attrapée lors de l'appel de getToken`, error);
  });
