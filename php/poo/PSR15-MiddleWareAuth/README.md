# Installation
se placer dans le répertoire contenant index.php et lancer
```bash
composer install
```
# Exécuter le code 
se placer dans le répertoire contenant index.php et lancer 
  ```bash php -S localhost:3000```

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
Dans cette version, nous ajoutons un middleware d'identification qui récupère un utilisateur dans un fichier config/users.json.
ATTENTION, l'identification est gérée par le middleware AuthMiddleware.
Soit l'utilisateur est déjà authentifié via la session, soit la requête est une soumission de formulaire de connexion et on vérifie simplement que les identifiants correspondent dans le fichier config/users.json
C'est une première étape vers une authentification réelle en base de données avec login et mot de passe correctement crypté

