<?php

// utilisation de l'autoload

use Diginamic\Controllers\ProductController;
use Diginamic\Views\ProductView;

require_once __DIR__ . "/vendor/autoload.php";



// Création de la variable $title
$title = "Présentation de produits";

// Contenu par défaut
$content = "<p>Bienvenue dans notre nouvelle boutique</p>";

// Récupération des infos provenant de la query string
if (isset($_GET["controller"])) {
  if ($_GET["controller"] == "products") {
    // je vais créer le contrôleur et appeler sa méthode displayAllProducts
    $productController = new ProductController();
    $content = $productController->displayAllProducts();
  }
};

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <header class="container">
    <h1><?= $title ?></h1>
  </header>
  <main class="container">
    <?= $content ?>
  </main>


</body>

</html>