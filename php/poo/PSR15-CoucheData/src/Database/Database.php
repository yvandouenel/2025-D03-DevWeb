<?php

namespace Diginamic\Framework\Database;

use PDO;
use PDOException;

class Database
{
  // Propriété statique qui représente l'instance unique
  private static ?PDO $instance = null;

  public static function getInstance(): PDO
  {
    if (self::$instance === null) {
      try {
        // On utilise ici les variables d'environnement
        $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=utf8mb4';
        self::$instance = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ]);
      } catch (PDOException $e) {
        throw new \Exception('Erreur de connexion à la base de données: ' . $e->getMessage());
      }
    }

    return self::$instance;
  }
}
