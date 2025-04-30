<?php

// utilisation de l'autoload
require_once __DIR__ . "/vendor/autoload.php";

use Diginamic\Models\Product;

// Création de la variable $title
$title = "Présentation de produits";

// Instanciation d'un produit
$tandem = new Product("VeloDuo", 4800, "Magnifique tandem hollandais", true);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?></title>
</head>

<body>
  <h1><?= $title ?></h1>
  <h2><?= $tandem->getName() ?></h2>
  <p><?= $tandem->getDescription() ?></p>

</body>

</html>