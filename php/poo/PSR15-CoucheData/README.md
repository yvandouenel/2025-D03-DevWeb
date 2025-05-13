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

 # Couche Data
Dans cette version, nous mettons en place le "pattern Repository" pour séparer la logique d'accès aux données du reste de l'application. Nous allons implémenter ce design pattern avec PDO et FETCH_CLASS.

Pour cela, nous allons créer : 
- le fichier .env. Attention à avoir 
  - installé la librairie phpdotenv : ``composer require vlucas/phpdotenv``
  - ajouter le fichier .env dans le gitignore tout en créant une copie .env.example pour éviter de partager des informations sensibles 
- une interface Repository : src\Repository\RepositoryInterface.php
- une première classe abstraite pour les fonctionnalités communes : src\Repository\AbstractRepository.php
- le modèle user : src\Model\User.php
- le repository spécifique à l'utilisateur : src\Repository\UserRepository.php
- la classe de connexion à la base de données : src\Database\Database.php

Puis il faut modifier AuthMiddleware pour utiliser le repository. Cf 

## Base de données
 - Créer une base de données qui correspond à DB_NAME du fichier .env
 - Créer un utilisateur qui correspond à DB_USER et DB_PASSWORD du fichier .env
 - Donner tous les droits à cet utilisateur pour la base de données DB_NAME du fichier .env
### Création de la table users
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
### Insertion de données dans la table users
-- Insérer un utilisateur de test (admin/admin)
INSERT INTO users (login, password, email) VALUES ('admin', 'admin', 'admin@example.com');
```
## Avantages du pattern Repository

- Séparation des préoccupations : La logique d'accès aux données est isolée du reste de l'application
- Testabilité : Vous pouvez facilement tester vos repositories en remplaçant la connexion à la base de données par un mock
- Réutilisabilité : Les méthodes communes sont dans la classe abstraite et peuvent être utilisées par tous les repositories
- Extensibilité : Vous pouvez facilement ajouter de nouvelles méthodes spécifiques à chaque type d'entité


