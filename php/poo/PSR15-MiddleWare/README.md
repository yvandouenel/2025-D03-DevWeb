# Installation
se placer dans le répertoire contenant index.php et lancer
```bash
composer install
```
# Exécuter le code 
se placer dans le répertoire contenant index.php et lancer 
  ```php -S localhost:3000```

# Explications
Cet exemple a pour but de montrer :
 - comment on peut récupérer les données issues d'une requête HTTP via GuzzleHttp
 - Renvoyer des infos sur la requette HTTP, en l'occurence 
  - Scheme (protocole)
  - Host (domaine)
  - Port
  - Path
  - QueryString
  - Fragment (ancre) 
 - les infos sont renvoyées en faisant un echo du body de $response. $response est une instance de use GuzzleHttp\Psr7\Response qui est retournée par la méthode handleRequest()
# Tests
A tester avec diverses url. Ex :
``http://localhost:3000/chemin?name=toto#chap1``
ou 
``curl -v http://localhost:3000/`` -v pour verbose pour donner un maximum d'informations notamment sur le header

Attention, les résultats peuvent être différents en fonction de votre OS et de la version de php. Cf [https://www.php.net/manual/fr/features.commandline.webserver.php] 

# Remarques 
Cette approche :
 - Encapsule la logique d'envoi de réponse
 - Gère proprement les headers et le status code
 - Se rapproche conceptuellement de l'approche Node.js et c'est l'approche adoptée par plusieurs frameworks PHP modernes comme Slim ou Laminas (ex-Zend).

 # Middleware
Dans cette version, nous ajoutons un middleware de "nettoyage" des entrées `InputSanitizerMiddleware`

- Objectif principal : Nettoyer et valider les données entrantes pour prévenir les injections et les attaques XSS
- Fonctionnement :

  - Intercepte les requêtes POST, PUT ou PATCH
  - Filtre les données soumises via les formulaires et le corps de la requête
  - Applique des fonctions de nettoyage comme strip_tags() et htmlspecialchars()
  - Supprime les caractères potentiellement dangereux


- Avantages :

  - Centralise la logique de sécurité des données entrantes
  - Évite la duplication de code de validation dans chaque contrôleur
  - Applique systématiquement les mêmes règles de sécurité à toutes les requêtes


- Position dans la chaîne :

  -  S'exécute généralement au début de la chaîne de middlewares
  -  Agit avant que les données ne soient traitées par d'autres middlewares ou le contrôleur


- Cas d'usage :

  - Formulaires utilisateur (inscription, contact)
  - APIs recevant des données JSON
  - Upload de fichiers (vérification des extensions et types MIME)


Le flux d'exécution est le suivant :

- Une requête arrive à index.php
- Le router trouve la route correspondante avec ses middlewares
- Le MiddlewareHandler est configuré avec tous les middlewares (globaux + spécifiques)
- Les middlewares sont exécutés en chaîne, dans l'ordre
- Si un middleware renvoie une réponse (ex: erreur 401), la chaîne est interrompue
- Sinon, le contrôleur final est exécuté

Pour compléter l'authentification, nous devrons :

- Mettre en place votre système d'authentification (session, JWT, etc.)
- Implémenter correctement la méthode isAuthenticated() dans AuthMiddleware
- Créer des contrôleurs et vues pour la connexion/inscription

Cette architecture est flexible et nous permet d'ajouter facilement d'autres types de middlewares selon les besoins.
