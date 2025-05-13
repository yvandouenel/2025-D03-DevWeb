<?php
try {
  $user = "root";
  $pass = "";
  $dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
  // utiliser la connexion ici
  $sth = $dbh->query('SELECT * FROM foo');

  while ($result =  $sth->fetch(PDO::FETCH_OBJ)) {
    //print_r($result);
    // Affiche le nom 
    echo $result->name;
    // echo $result['name'];
    print "\n";
  }



  // et maintenant, fermez-la !
  $sth = null;
  $dbh = null;
} catch (PDOException $e) {
  // tenter de réessayer la connexion après un certain délai, par exemple
  error_log("Problème de connexion à la base de données.");
  var_dump($e);
}
