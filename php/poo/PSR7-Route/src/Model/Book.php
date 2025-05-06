<?php

namespace Diginamic\Framework\Model;

class Book
{
  private static $books = null;

  // Charger les données depuis le fichier
  private static function loadBooks()
  {
    if (self::$books === null) {
      self::$books = require_once __DIR__ . '/../Data/books.php';
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
    // Formatage du contenu du fichier
    $content = "<?php\n// src/Data/books.php\n\nreturn " . var_export($books, true) . ";\n";

    // Écriture dans le fichier
    $filePath = __DIR__ . '/../Data/books.php';

    // Vérification que le répertoire existe
    $directory = dirname($filePath);
    if (!is_dir($directory)) {
      mkdir($directory, 0755, true);
    }

    // Sauvegarde dans le fichier
    if (file_put_contents($filePath, $content) !== false) {
      // Mise à jour de la variable statique en mémoire
      self::$books = $books;
      return true;
    }

    return false;
  }
}
