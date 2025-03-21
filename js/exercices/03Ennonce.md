# Mini Exercice JavaScript(15 min)

## Objectif
Créer un calculateur de prix total avec réduction conditionnelle.

## Consignes

1. Créez trois variables pour représenter les prix de différents articles:
- `prixArticle1` = 25.99
  - `prixArticle2` = 45.50
    - `prixArticle3` = 34.99

2. Créez une fonction `calculerTotal(estMembre)` qui:
- Calcule la somme des trois prix
  - Applique une réduction de 10 % si`estMembre` est true
    - Retourne le total

3. Créez une fonction `afficherResultat(total)` qui:
- Affiche "Achat économique!" si le total est inférieur à 50
  - Affiche "Bon achat!" si le total est entre 50 et 100
    - Affiche "Achat premium!" si le total est supérieur à 100

4. Testez votre code en appelant les fonctions pour un membre et un non - membre

## Exemple de structure
  ```javascript
// Définir les prix des articles
const prixArticle1 = 25.99;
const prixArticle2 = 45.50;
const prixArticle3 = 34.99;

// Fonction pour calculer le total
function calculerTotal(estMembre) {
  // À compléter
  // 1. Calculer la somme des prix
  // 2. Appliquer la réduction si estMembre est true
  // 3. Retourner le total
}

// Fonction pour afficher un message selon le montant
function afficherResultat(total) {
  // À compléter
  // Utiliser des conditions pour afficher le message approprié
}

// Tests
const totalSansMembre = calculerTotal(false);
console.log("Total sans réduction:", totalSansMembre);
afficherResultat(totalSansMembre);

const totalAvecMembre = calculerTotal(true);
console.log("Total avec réduction:", totalAvecMembre);
afficherResultat(totalAvecMembre);
```