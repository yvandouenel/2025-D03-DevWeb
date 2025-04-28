fetch("https://www.coopernet.fr/session/token")
  .then(response => {
    console.log(`response.status`, response.status);
    if (response.status == 200) {
      return response.text()
    } else {
      throw new Error("Erreur serveur : statut " + response.status);
    }
  })
  .then((token) => {
    console.log(`token`, token);
  })
  .catch(error => {
    console.error(`Erreur attrapée lors de l'appel à fetch`, error);
  })