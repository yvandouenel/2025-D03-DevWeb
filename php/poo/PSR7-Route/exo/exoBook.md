# Création d'une API REST simple pour une bibliothèque
Objectif : Créer une API REST pour gérer une petite bibliothèque de livres.
Consignes :

Créer un modèle Book avec les attributs : id, titre, auteur, année de publication, genre
Implémenter les routes suivantes :

- GET /api/books : Liste tous les livres (format JSON)
- GET /api/books/{id} : Affiche les détails d'un livre spécifique
- POST /api/books : Ajoute un nouveau livre
- PUT /api/books/{id} : Met à jour un livre existant
- DELETE /api/books/{id} : Supprime un livre


Créer un contrôleur BookController qui implémente ces fonctionnalités
Stocker les données dans un tableau PHP comme expliqué ci-dessous
Assurer que les réponses respectent les codes HTTP appropriés

## Structure du projet
src/
├── Controller/
│   └── BookController.php
├── Model/
│   └── Book.php
└── Data/
    └── books.php

## Gestion des données :
Pour cet exercice, nous allons stocker les données dans un simple fichier PHP qui retourne un tableau. Créez un fichier src/Data/books.php avec le contenu suivant :
```php
<?php
// src/Data/books.php

return [
    [
        'id' => 1,
        'title' => 'Le Petit Prince',
        'author' => 'Antoine de Saint-Exupéry',
        'year' => 1943,
        'genre' => 'Conte philosophique'
    ],
    [
        'id' => 2,
        'title' => '1984',
        'author' => 'George Orwell',
        'year' => 1949,
        'genre' => 'Science-fiction'
    ],
    [
        'id' => 3,
        'title' => 'Dune',
        'author' => 'Frank Herbert',
        'year' => 1965,
        'genre' => 'Science-fiction'
    ],
    [
        'id' => 4,
        'title' => 'Les Misérables',
        'author' => 'Victor Hugo',
        'year' => 1862,
        'genre' => 'Roman historique'
    ],
    [
        'id' => 5,
        'title' => 'Le Seigneur des Anneaux',
        'author' => 'J.R.R. Tolkien',
        'year' => 1954,
        'genre' => 'Fantasy'
    ]
];

```
## Modèle Book
```php
<?php
// src/Model/Book.php

namespace App\Model;

class Book
{
    private static $books = null;
    
    // Charger les données depuis le fichier
    private static function loadBooks()
    {
        if (self::$books === null) {
            self::$books = require __DIR__ . '/../Data/books.php';
        }
        return self::$books;
    }
    
    // Récupérer tous les livres
    public static function getAll()
    {
        return self::loadBooks();
    }
    
    // Récupérer un livre par son ID
    public static function getById($id)
    {
        $books = self::loadBooks();
        foreach ($books as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }
        return null;
    }
    
    // Ajouter un nouveau livre
    public static function add($book)
    {
        $books = self::loadBooks();
        
        // Générer un nouvel ID
        $maxId = 0;
        foreach ($books as $existingBook) {
            if ($existingBook['id'] > $maxId) {
                $maxId = $existingBook['id'];
            }
        }
        $book['id'] = $maxId + 1;
        
        // Ajouter le livre
        $books[] = $book;
        
        // Sauvegarder les modifications
        self::saveBooks($books);
        
        return $book;
    }
    
    // Mettre à jour un livre existant
    public static function update($id, $updatedBook)
    {
        $books = self::loadBooks();
        $found = false;
        
        foreach ($books as $key => $book) {
            if ($book['id'] == $id) {
                $updatedBook['id'] = $id; // Conserver l'ID d'origine
                $books[$key] = $updatedBook;
                $found = true;
                break;
            }
        }
        
        if ($found) {
            self::saveBooks($books);
            return $updatedBook;
        }
        
        return null;
    }
    
    // Supprimer un livre
    public static function delete($id)
    {
        $books = self::loadBooks();
        $found = false;
        
        foreach ($books as $key => $book) {
            if ($book['id'] == $id) {
                unset($books[$key]);
                $found = true;
                break;
            }
        }
        
        if ($found) {
            // Réindexer le tableau
            $books = array_values($books);
            self::saveBooks($books);
            return true;
        }
        
        return false;
    }
    
    // Sauvegarder les modifications dans le fichier
    private static function saveBooks($books)
    {
        // Dans un environnement réel, nous écririons dans le fichier
        // Pour cet exercice, nous stockons simplement en mémoire
        self::$books = $books;
        
        // Note : Dans un vrai projet, vous pourriez ajouter du code comme :
        // file_put_contents(__DIR__ . '/../Data/books.php', '<?php return ' . var_export($books, true) . ';');
    }
}
```
Votre travail consiste en : 
- Créer les fichiers selon la structure fournie
- créer les routes
- créer le controleur BookControler avec les méthodes getAll, getOne, create, update, delete
- Compléter le code si nécessaire pour l'adapter à notre framework
- Tester chaque endpoint de l'API avec un outil comme Postman ou cURL ou thunder client
