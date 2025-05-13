<?php

class Database
{

  // Attributs
  private static $instance = null;
  private $user = "root";
  private  $pass = "";
  private $dbh;
  public $test = "initial";

  // Le constructeur ne peut être appelé que depuis la classe
  private function __construct()
  {

    $this->dbh = new PDO('mysql:host=localhost;dbname=test', $this->user, $this->pass);
  }
  // Cette méthode statique peut être appelée depuis la classe sans que l'on ait d'instance
  public static function getInstance()
  {
    // Soit l'instance n'est pas encore créée et on la créee avant de la renvoyé
    if (self::$instance === null) {

      // Création d'une nouvelle instance
      self::$instance = new Database();
    }

    // Renvoie de l'instance
    return self::$instance;
  }
  public function sqlRequest()
  {
    $sth = $this->dbh->query('SELECT * FROM foo');
    while ($result =  $sth->fetch(PDO::FETCH_OBJ)) {
      // Affiche le nom 
      echo $result->name;

      print "\n";
    }
  }
}

// En dehors de la classe
// Récupération d'une instance de Database (un singleton)
$db1 = Database::getInstance();

// Appel de sqlRequest
$db1->sqlRequest();

$db2 = Database::getInstance();

$db1->test = "Après";

echo $db1->test . PHP_EOL;
echo $db2->test . PHP_EOL;

// Teste si $db1 et $db2 sont bien les mêmes

if ($db1 === $db2) {
  echo "les deux variables db1  et db2 'pointent' vers la même instance de Database";
}
