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
 - Comment on peut récupérer les données issues d'une requête HTTP dans le cadre des PSR (GuzzleHttp)
 - Utiliser un système de route pour savoir 
   - quel middleware doit être appelé
   - quelle méthode de quel contrôleur doit être appelée. 
 - Le contrôleur :
   - utilise un "Repository" qui fera le lien entre la base de données et le modèle grâce à l'utilisation de PDO.
   - renvoie une réponse HTTP toujours dans le cadres des PSR et à l'aide de templates (twig)

# Routes
Les routes sont déclarées dans le fichier src/Router/routes.php
Les middlewares sont associés à des routes soit dans le fichier index.php soit dans le fichier src/Router/routes.php
## Ordre de déclaration des routes
ATTENTION, l'ordre de déclaration des routes dans le fichier src/Router/routes.php a un impact conséquent.
Par exemple, la route ayant pour chemin /users/add doit impérativement être déclarée avant la route qui a pour chemin /users/{id}.
Sinon, la route /users/add ne sera jamais reconnue (car elle correspond également à la route /users/{id})
# Premières requêtes
A tester avec diverses url. Ex :
``http://localhost:3000/users``
ou 
``curl -v http://localhost:3000/login`` -v pour verbose pour donner un maximum d'informations notamment sur le header

Attention, les résultats peuvent être différents en fonction de votre OS et de la version de php. Cf [https://www.php.net/manual/fr/features.commandline.webserver.php] 


# Couche Data
Nous avons mis en place le "pattern Repository" pour séparer la logique d'accès aux données du reste de l'application. Nous allons implémenter ce design pattern avec PDO et FETCH_CLASS.

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
ou si hashage
```sql
INSERT INTO users (login, password, email) VALUES ('admin', '$2y$10$9XWuYcgATZXjjpJT5LsA6.L6lNCsLRpBB9dhGN8Lz0VeKH2NQURty', 'admin@example.com');
````
## Avantages du pattern Repository

- Séparation des préoccupations : La logique d'accès aux données est isolée du reste de l'application
- Testabilité : Vous pouvez facilement tester vos repositories en remplaçant la connexion à la base de données par un mock
- Réutilisabilité : Les méthodes communes sont dans la classe abstraite et peuvent être utilisées par tous les repositories
- Extensibilité : Vous pouvez facilement ajouter de nouvelles méthodes spécifiques à chaque type d'entité

# Couche sécurité
Dans cette couche, nous nous sommes assurés que :
- le mot de passe fait au moins 12 caractères et qu'il comprend des lettres majuscules, minuscules, un nombre et un caractère spécial
- l'utilisateur ne peut pas tenter de s'identifier  plus de 3 fois 
- l'application est protégée contre les injections sql (requête préparée)
- l'application est protégée contre les injections xss (via le middleware qui enlève les balises)
- l'application est protégée contre les failles CSRF (via un token ajouté dans chaque formulaire qui emploie la méthode POST)
