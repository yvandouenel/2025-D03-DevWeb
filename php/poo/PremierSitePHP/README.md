# Installation 
Récupérer le code sur le repository git

se placer dans le répertoire Premier site PHP
```bash
composer install
```
# Objectif
Création d'un mini site web avec :
- PSR-0
- PSR-4 (autoloading avec composer)
- On va donc utiliser des classes 
- Mieux comprendre les requêtes HTTP


# Contexte
- Site web qui présente des produits
- Utilisation du serveur de développement fournit par PHP

# Structure du projet à terme
mon-site/
├─ index.php
├── src/
│   ├── Controllers/
│   ├── Models/
│   └── Views/
├── vendor/
└── composer.json

# 1ère étape
Créer le projet à l'aide de composer

# 2ième étape
Afficher dès la page d'accueil un produit

# 3ième étape 
Créer une interface de la classe Product avec pour méthodes 
getName,
getPrice,
getDescription
isAvailable
...
Puis implémentez avec les bonnes méthodes la classe Product

