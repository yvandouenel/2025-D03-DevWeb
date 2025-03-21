let prixArticle1 = 25.99;
let prixArticle2 = 45.50;
let prixArticle3 = 34.99;

function calculerTotal(estMembre) {
  const total = prixArticle1 + prixArticle2 + prixArticle3;
  if (estMembre == true) {
    total = 0.9 * total;
  }
  return total;
}

function afficherResultat(total) {
  if (total < 50) {
    console.log(`Achat économique !`);
  } else if (total < 100 && total > 50) {
    console.log(`bon achat !`);
  } else {
    console.log(`Achat premium`);
  }
}
const totalPourNonAdherent = calculerTotal(false);
afficherResultat(totalPourNonAdherent);