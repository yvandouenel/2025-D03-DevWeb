<?php

// utilisation de l'autoload

use Diginamic\Controllers\ProductController;

require_once __DIR__ . "/vendor/autoload.php";



// Création de la variable $title
$title = "Présentation de produits";

// Contenu par défaut
$content = "<p>Bienvenue dans notre nouvelle boutique</p>";

// Récupération des infos provenant de la query string
if (isset($_GET["controller"])) {
  if ($_GET["controller"] == "products") {
    // je vais appeler le contrôleur et sa méthode getAllProducts
    $productController = new ProductController();
    $productController->getAllProducts();
  }
};

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
  <?= $content ?>

</body>

</html>